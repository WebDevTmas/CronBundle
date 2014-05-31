<?php

namespace Tmas\CronBundle\Service;

use DateRepetition\DateRepetitionInterpeter;
use DateRepetition\TimeProvider;
use Tmas\CronBundle\Entity\CronJob;

class CronScheduler 
{
    private $timeProvider;
    private $scheduledJobs = array();

    public function __construct(TimeProvider $timeProvider)
    {
        $this->timeProvider = $timeProvider;
    }

    public function addJob($service, $method, $dateRepetitionString)
    {
        $dateRepetition = DateRepetitionInterpeter::newDateRepetitionFromString($dateRepetitionString);        
        $this->scheduledJobs[] = new CronJob($this->timeProvider, $service, $method, $dateRepetition);
    }

    public function execute()
    {
        $countExecuted  = 0;
        foreach($this->scheduledJobs as $job) {
            if($job->isNow()) {
                $job->run();
                $countExecuted++;
            }
        }

        return $countExecuted;
    }

    public function getAllScheduledJobs()
    {
        return $this->scheduledJobs;
    }
}

