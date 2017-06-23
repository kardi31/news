<?php

namespace Kardi\NewsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kardi_news');

        $rootNode->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('router')
                    ->defaultValue('kardi_news.router.category')
                ->end()
            ->end();
        return $treeBuilder;
    }
}
