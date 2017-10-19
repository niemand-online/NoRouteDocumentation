<?php declare(strict_types=1);

namespace NoRouteDocumentation\Factory;

use NoRouteDocumentation\Exception\RouteCollectionSerializerNotFound;
use NoRouteDocumentation\Serializer\RouteCollectionSerializerInterface;

/**
 * Class RouteCollectionSerializerFactory
 * @package NoRouteDocumentation\Factory
 */
class RouteCollectionSerializerFactory
{
    /**
     * @param string $targetType
     * @return RouteCollectionSerializerInterface
     * @throws RouteCollectionSerializerNotFound
     */
    public function createByTargetType(string $targetType): RouteCollectionSerializerInterface
    {
        throw new RouteCollectionSerializerNotFound($targetType);
    }
}
