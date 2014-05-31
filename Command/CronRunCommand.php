<?php

namespace Tmas\CronBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CronRunCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cron:run')
            ->setDescription('Run cron jobs')
            ->setHelp('Runs cron jobs scheduled for now');
    }

    protected function execute(InputInterface $input, OutputInterface $output) 
    {
		$this->getContainer()->get('tmas.cron.scheduler')->execute();
    }
}


