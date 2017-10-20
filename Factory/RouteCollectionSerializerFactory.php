<?php declare(strict_types=1);

namespace NoRouteDocumentation\Factory;

use NoRouteDocumentation\Exception\RouteCollectionSerializerNotFound;
use NoRouteDocumentation\Serializer\RouteCollectionSerializerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RouteCollectionSerializerFactory
 * @package NoRouteDocumentation\Factory
 */
class RouteCollectionSerializerFactory
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * RouteCollectionSerializerFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $targetType
     * @return RouteCollectionSerializerInterface
     * @throws RouteCollectionSerializerNotFound
     */
    public function createByTargetType(string $targetType): RouteCollectionSerializerInterface
    {
        /** @var RouteCollectionSerializerInterface $result */
        $result = null;

        switch (strtolower($targetType)) {
            case 'json:basic':
                $result = $this->container->get('no_route_documentation.route_collection_serializer.as_json_serializer');
                break;
            case 'json:detail':
                $result = $this->container->get('no_route_documentation.route_collection_serializer.as_json_detail_serializer');
                break;
        }

        if (!$result) {
            throw new RouteCollectionSerializerNotFound($targetType);
        }

        return $result;
    }
}
