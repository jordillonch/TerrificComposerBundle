<?php

/*
 * This file is part of the Terrific Composer Bundle.
 *
 * (c) Remo Brunschwiler <remo@terrifically.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Terrific\ComposerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Remo Brunschwiler <remo@terrifically.org>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('terrific_composer');

        $rootNode
            ->children()
                ->scalarNode('toolbar')->defaultFalse()->end()
                ->arrayNode('composition_bundles')
                    ->defaultValue(array('@TerrificComposition'))
                    ->beforeNormalization()
                        ->ifTrue(function($v){ return !is_array($v); })
                        ->then(function($v){ return array($v); })
                    ->end()
                    ->beforeNormalization()
                        ->always()
                        ->then(function($v) {
                            $bundles = array();

                            // trim and add @ if not existent
                            foreach ($v as $key => $bundle) {
                                $bundle = trim($bundle);

                                if(strpos($bundle, '@') === false) {
                                    $bundle = '@'.$bundle;
                                }
                                $bundles[$key] = $bundle;
                            }

                            return $bundles;
                        })
                    ->end()
                    ->prototype('scalar')->end()
                ->end()
                ->scalarNode('module_layout')
                    ->beforeNormalization()
                        ->always()
                        ->then(function($v) {
                            return str_replace('@', '', $v);
                        })
                    ->end()
                   ->defaultValue('TerrificComposition::base.html.twig')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
