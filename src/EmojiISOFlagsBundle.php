<?php


namespace Rteeom\EmojiISOFlagsBundle;

use Rteeom\EmojiISOFlagsBundle\Service\FlagsGenerator;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class EmojiISOFlagsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->registerForAutoconfiguration(FlagsGenerator::class)->addTag('rteeom.service');
    }
}