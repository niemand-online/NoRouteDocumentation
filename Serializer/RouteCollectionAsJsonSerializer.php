<?php declare(strict_types=1);

namespace NoRouteDocumentation\Serializer;

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
     * @param RouteCollection $routes
     * @param OutputInterface $output
     */
    public function serializeRouteCollection(RouteCollection $routes, OutputInterface $output): void
    {
        $result = [];

        foreach ($routes as $route) {
            $result[] = $this->serializeRoute($route);
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
