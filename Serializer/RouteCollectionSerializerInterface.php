<?php declare(strict_types=1);

namespace NoRouteDocumentation\Serializer;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\RouteCollection;

/**
 * Interface RouteCollectionSerializerInterface
 * @package NoRouteDocumentation\Serializer
 */
interface RouteCollectionSerializerInterface
{
    public function serializeRouteCollection(RouteCollection $routes, OutputInterface $output): void;
}
