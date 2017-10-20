<?php declare(strict_types=1);

namespace NoRouteDocumentation\Command;

use NoRouteDocumentation\Factory\RouteCollectionSerializerFactory;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
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
            ->addArgument('format', InputArgument::REQUIRED, 'The target format (json)');
    }

    /**
     * @inheritdoc
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->getSerializerFactory()
            ->createByTargetType($input->getArgument('format'))
            ->serializeRouteCollection($this->getRouter()->getRouteCollection(), $output);
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
}
