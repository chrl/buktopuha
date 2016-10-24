<?php

namespace Chrl\AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('buktopuha');


        $rootNode
                ->children()
                    ->scalarNode("token")->isRequired()->end()
                    ->scalarNode("bot_name")->end()
                    ->arrayNode("webhook")
                    ->children()
                        ->scalarNode("domain")->end()
                        ->scalarNode("path_prefix")->end()
                        ->scalarNode("update_receiver")->defaultValue("app.update_receiver")->end()
                    ->end()
                    ->end()
                ->end();


        return $treeBuilder;
    }
}
