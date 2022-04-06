<?php

namespace EfTech\ContactList\Infrastructure\Db\SymfonyDi;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class DiDbConfigurator implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('e_db');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('connect')
                    ->fixXmlConfig('option', 'options')
                    ->children()
                        ->scalarNode('dbType')
                            ->isRequired()
                        ->end()
                        ->scalarNode('user')
                            ->isRequired()
                        ->end()
                        ->scalarNode('password')
                            ->isRequired()
                        ->end()
                        ->scalarNode('dbName')
                            ->isRequired()
                        ->end()
                        ->scalarNode('host')
                            ->isRequired()
                        ->end()
                        ->scalarNode('port')
                            ->isRequired()
                        ->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('name')
                            ->arrayPrototype()
                                ->children()
                                    ->scalarNode('name')
                                        ->isRequired()
                                    ->end()
                                    ->scalarNode('value')
                                        ->isRequired()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()


                ->arrayNode('orm')
                    ->fixXmlConfig('path', 'paths')
                    ->fixXmlConfig('eventSubscriber', 'eventSubscribers')
                    ->children()
                        ->arrayNode('paths')
                            ->scalarPrototype()
                            ->end()
                        ->end()
                        ->arrayNode('eventSubscribers')
                            ->scalarPrototype()
                            ->end()
                        ->end()
                    ->booleanNode('isDevMode')
                        ->defaultFalse()
                    ->end()
                    ->scalarNode('proxyDir')
                        ->defaultNull()
                    ->end()
                ->end()
            ->end()


            ->end()
        ->end();
        return $treeBuilder;
    }
}
