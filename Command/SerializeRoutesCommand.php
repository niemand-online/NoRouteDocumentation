<?php declare(strict_types=1);

namespace NoRouteDocumentation\Command;

use NoRouteDocumentation\Factory\RouteCollectionSerializerFactory;
use Shopware\Context\Struct\TranslationContext;
use Shopware\Shop\Repository\ShopRepository;
use Shopware\Shop\Struct\ShopBasicStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class SerializeRoutesCommand
 * @package NoRouteDocumentation\Command
 */
class SerializeRoutesCommand extends ContainerAwareCommand
{
    /**
     * SerializeRoutesCommand constructor.
     * @param null $name
     */
    public function __construct($name = null)
    {
        parent::__construct('no:routes:serialize');
    }

    /**
     * @inheritdoc
     */
    protected function configure(): void
    {
        $this->setDescription('Serialize all the routes')
            ->addArgument('format', InputArgument::REQUIRED, 'The target format (json)')
            ->addArgument('shop', InputArgument::REQUIRED, 'The primary key of the shop')
            ->addOption('output', 'o', InputOption::VALUE_REQUIRED, 'The output filename (if omitted it prints into the commandline)');
    }

    /**
     * @inheritdoc
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $serializerOutput = $output;

        if (!empty($input->getOption('output'))) {
            $serializerOutput = new StreamOutput(fopen($input->getOption('output'), 'w'));
        }

        /// TODO improve shop handling
        $shopKey = $input->getArgument('shop');
        /** @var ShopBasicStruct $shop */
        $shop = $this->getShopRepository()->read([$shopKey], new TranslationContext($shopKey, true, $shopKey))->getIterator()->current();

        $this->getSerializerFactory()
            ->createByTargetType($input->getArgument('format'))
            ->serializeRouteCollection($shop, $this->getRouter()->getRouteCollection(), $serializerOutput);
    }

    /**
     * @var RouteCollectionSerializerFactory
     */
    private $serializerFactory;

    /**
     * @return RouteCollectionSerializerFactory
     */
    protected function getSerializerFactory(): RouteCollectionSerializerFactory
    {
        return $this->serializerFactory = ($this->serializerFactory ?? $this->getContainer()->get('no_route_documentation.factory.route_collection_serializer'));
    }

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @return RouterInterface
     */
    protected function getRouter(): RouterInterface
    {
        return $this->router = ($this->router ?? $this->getContainer()->get('router'));
    }

    /**
     * @var ShopRepository
     */
    private $shopRepository;

    /**
     * @return ShopRepository
     */
    public function getShopRepository(): ShopRepository
    {
        return $this->shopRepository = ($this->shopRepository ?? $this->getContainer()->get('shopware.shop.repository'));
    }
}
