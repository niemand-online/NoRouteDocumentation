<?php declare(strict_types=1);

namespace NoRouteDocumentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FrontendController
 * @package NoRouteDocumentation\Controller
 * TODO make backend module
 */
class FrontendController extends Controller
{
    /**
     * @Route("/no_route_documentation")
     */
    public function indexAction()
    {
        $template = $this->get('shopware.storefront.twig.template_finder')->find('no_route_documentation/index.html.twig', true);
        return $this->render($template);
    }
}
