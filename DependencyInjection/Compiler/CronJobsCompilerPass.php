<?php

namespace Tmas\CronBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;

class CronJobsCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) 
    {
        if($container->hasDefinition('tmas.cron.scheduler')) {
			$definition = $container->findDefinition('tmas.cron.scheduler');
            
            $taggedServices = $container->findTaggedServiceIds('tmas.cron.job');
            foreach($taggedServices as $id => $attributes) {
                $definition->addMethodCall(
                    'addJob',
                    array(new Reference($id), $attributes[0]['method'], $attributes[0]['repetition'])
                );
            }
		}
    }
}

