<?php declare(strict_types=1);

namespace NoRouteDocumentation\Controller;

use NoRouteDocumentation\Factory\RouteDetailStructFactory;
use NoRouteDocumentation\Struct\RouteDetailStruct;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Shopware\Api\ApiContext;
use Shopware\Api\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

/**
 * @Route(service="no_route_documentation.controller.no_routes.api_controller", path="/api")
 */
class NoRoutesController extends ApiController
{
    /**
     * @var RouteDetailStructFactory
     */
    private $routeDetailStructFactory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * NoRoutesController constructor.
     * @param RouteDetailStructFactory $routeDetailStructFactory
     * @param RouterInterface $router
     */
    public function __construct(RouteDetailStructFactory $routeDetailStructFactory, RouterInterface $router)
    {
        $this->routeDetailStructFactory = $routeDetailStructFactory;
        $this->router = $router;
    }

    /**
     * @Route("/no_route.{responseFormat}", name="api.no_routes.list", methods={"GET"})
     *
     * @param Request    $request
     * @param ApiContext $context
     *
     * @return Response
     */
    public function listAction(Request $request, ApiContext $context): Response
    {
        /** @var RouteDetailStruct[] $detailedRoutes */
        $detailedRoutes = [];
        $baseUrl = ($context->getShopContext()->getShop()->getIsSecure() ? 'https' : 'http').'://'.$context->getShopContext()->getShop()->getHost();

        foreach ($this->router->getRouteCollection() as $route) {
            $detailedRoute = $this->routeDetailStructFactory->hydrate($route);
            $detailedRoute->setFullPath($baseUrl.$detailedRoute->getPath());
            $detailedRoutes[] = $detailedRoute;
        }

        return $this->createResponse(
            ['data' => $detailedRoutes, 'total' => count($detailedRoutes)],
            $context
        );
    }

    /**
     * @return string
     */
    protected function getXmlRootKey(): string
    {
        return 'products';
    }

    /**
     * @return string
     */
    protected function getXmlChildKey(): string
    {
        return 'product';
    }
}
