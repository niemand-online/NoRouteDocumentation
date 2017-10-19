<?php declare(strict_types=1);

namespace NoRouteDocumentation;

use Shopware\Framework\Plugin\Plugin;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class NoRouteDocumentation
 * @package NoRouteDocumentation
 */
class NoRouteDocumentation extends Plugin
{
    /**
     * @var string
     */
    protected $name = 'NoRouteDocumentation';

    /**
     * @inheritdoc
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/DependencyInjection/'));
        $loader->load('services.xml');
    }
}
