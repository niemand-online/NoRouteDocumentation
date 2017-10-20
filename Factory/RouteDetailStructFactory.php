<?php declare(strict_types=1);

namespace NoRouteDocumentation\Factory;

use NoRouteDocumentation\Struct\RouteDetailStruct;
use ReflectionClass;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Route;

/**
 * Class RouteDetailStructFactory
 * @package NoRouteDocumentation\Factory
 */
class RouteDetailStructFactory
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * RouteDetailStructFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Route $route
     * @return RouteDetailStruct
     */
    public function hydrate(Route $route): RouteDetailStruct
    {
        $result = new RouteDetailStruct();

        $result->setHttpMethod($this->getFavoriteMethod($route->getMethods()));
        $result->setPath($route->getPath());

        if ($route->hasOption('seo')) {
            $result->setSeo(boolval($route->getOption('seo')));
        }

        if ($route->hasDefault('_controller')) {
            $controller = $route->getDefault('_controller');
            $class = '';

            if (strpos($controller,'::') !== false) {
                list($class, $method) = explode('::', $controller);
                $result->setControllerClassName($class);
                $result->setMethodName($method);
            } else {
                list($service, $method) = explode(':', $controller);
                $result->setControllerServiceId($service);
                $result->setMethodName($method);

                if ($this->container->has($service)) {
                    $result->setControllerClassName($class = get_class($this->container->get($service)));
                }
            }

            $reflectionClass = new ReflectionClass($class);
            $result->setControllerFilename($reflectionClass->getFileName());
        }

        return $result;
    }

    /**
     * @param string[] $methods
     * @return string
     */
    protected function getFavoriteMethod(array $methods): string
    {
        if (empty($methods)) {
            return 'GET';
        }

        return $methods[0];
    }
}
