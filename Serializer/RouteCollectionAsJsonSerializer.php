<?php declare(strict_types=1);

namespace NoRouteDocumentation\Serializer;

use Shopware\Shop\Struct\ShopBasicStruct;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class RouteCollectionAsJsonSerializer
 * @package NoRouteDocumentation\Serializer
 */
class RouteCollectionAsJsonSerializer implements RouteCollectionSerializerInterface
{
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
            $serializedRoute = $this->serializeRoute($route);
            $serializedRoute['path'] = $shopUrlPrefix.$serializedRoute['path'];
            $result[] = $serializedRoute;
        }

        $output->writeln(json_encode($result, JSON_PRETTY_PRINT));
    }

    /**
     * @param Route $route
     * @return array
     */
    protected function serializeRoute(Route $route): array
    {
        return unserialize($route->serialize());
    }
}
