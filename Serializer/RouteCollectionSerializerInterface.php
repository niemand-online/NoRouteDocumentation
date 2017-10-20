<?php declare(strict_types=1);

namespace NoRouteDocumentation\Serializer;

use Shopware\Shop\Struct\ShopBasicStruct;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\RouteCollection;

/**
 * Interface RouteCollectionSerializerInterface
 * @package NoRouteDocumentation\Serializer
 */
interface RouteCollectionSerializerInterface
{
    /**
     * Serializes the given routes and shop information into the output.
     * @param ShopBasicStruct $basicShop
     * @param RouteCollection $routes
     * @param OutputInterface $output
     */
    public function serializeRouteCollection(ShopBasicStruct $basicShop, RouteCollection $routes, OutputInterface $output): void;
}
