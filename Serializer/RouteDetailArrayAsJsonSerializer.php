<?php declare(strict_types=1);

namespace NoRouteDocumentation\Serializer;

use NoRouteDocumentation\Factory\RouteDetailStructFactory;
use Shopware\Shop\Struct\ShopBasicStruct;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class RouteDetailArrayAsJsonSerializer
 * @package NoRouteDocumentation\Serializer
 */
class RouteDetailArrayAsJsonSerializer implements RouteCollectionSerializerInterface
{
    /**
     * @var RouteDetailStructFactory
     */
    private $routeDetailStructFactory;

    /**
     * RouteCollectionAsJsonSerializer constructor.
     * @param RouteDetailStructFactory $routeDetailStructFactory
     */
    public function __construct(RouteDetailStructFactory $routeDetailStructFactory)
    {
        $this->routeDetailStructFactory = $routeDetailStructFactory;
    }

    /**
     * @param ShopBasicStruct $basicShop
     * @param RouteCollection $routes
     * @param OutputInterface $output
     */
    public function serializeRouteCollection(ShopBasicStruct $basicShop, RouteCollection $routes, OutputInterface $output): void
    {
        $result = [];
        $shopUrlPrefix = ($basicShop->getIsSecure() ? 'https' : 'http').'://'.$basicShop->getHost();

        foreach ($routes as $route) {
            $detail = $this->routeDetailStructFactory->hydrate($route);
            $detail->setFullPath($shopUrlPrefix.$detail->getPath());
            $result[] = $detail;
        }

        $output->writeln(json_encode($result, JSON_PRETTY_PRINT));
    }
}
