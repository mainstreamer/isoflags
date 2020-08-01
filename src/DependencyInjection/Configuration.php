<?php


namespace Rteeom\EmojiISOFlagsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        return new TreeBuilder('flags');
//        $treeBuilder->root('health_check');
//        return $treeBuilder;
    }
}