<?php

namespace Tmas\CronBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class CronListCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cron:list')
            ->setDescription('List all cron jobs')
            ->setHelp('List all cron jobs for constituent');
    }

    protected function execute(InputInterface $input, OutputInterface $output) 
    {
   		$jobs = $this->getContainer()->get('tmas.cron.scheduler')->getAllScheduledJobs();
        $jobs = array_map(function($job) {
            return array(get_class($job->getService()), $job->getMethod(), $job->getDateRepetitionString());
        }, $jobs);

        $output->writeln('List of all jobs');

        $table = $this->getHelperSet()->get('table');
        $table
            ->setHeaders(array('Service', 'Method', 'at'))
            ->setRows($jobs);
        $table->render($output);    

    }
}


