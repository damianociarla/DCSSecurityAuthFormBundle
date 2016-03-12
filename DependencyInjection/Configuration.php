<?php

namespace DCS\Security\Auth\FormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dcs_security_auth_form');

        $rootNode
            ->children()
                ->scalarNode('view')
                    ->defaultValue('DCSSecurityAuthFormBundle:Security:login.html.twig')
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('csrf_token')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enable')
                            ->defaultTrue()
                        ->end()
                        ->scalarNode('parameter')
                            ->defaultValue('_csrf_token')
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('id')
                            ->defaultValue('authenticate')
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}