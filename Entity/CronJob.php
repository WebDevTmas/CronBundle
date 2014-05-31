<?php

namespace Tmas\CronBundle\Entity;

use DateRepetition\DateRepetition;
use DateRepetition\DateRepetitionCalculator;
use DateRepetition\DateRepetitionInterpeter;
use DateRepetition\TimeProvider;
use DateTime;

class CronJob
{
    private $timeProvider;
    private $service;
    private $method;
    private $dateRepetition;
    private $dateRepetitionCalculator; 

    public function __construct(TimeProvider $timeProvider, $service, $method, DateRepetition $dateRepetition) 
    {
        $this->timeProvider = $timeProvider;
        $this->service = $service;
        $this->method = $method;
        $this->dateRepetition = $dateRepetition;
        $this->dateRepetitionCalculator = new DateRepetitionCalculator($timeProvider);
    }

    public function run()
    {
        $method = $this->method;
        return $this->service->$method();
    }

    public function getDateRepetition()
    {
        return $this->dateRepetition;
    }

    public function isNow()
    {
        $nearestOccurence = $this->dateRepetitionCalculator->getNearestOccurence($this->dateRepetition);
        $now = $this->timeProvider->now();
        return $nearestOccurence->getTimeStamp() == $now->getTimeStamp() && !$this->isSecondOccurence($nearestOccurence);
    }

    public function getNearestRun()
    {
        return $this->dateRepetitionCalculator->getNearestOccurence($this->dateRepetition);
    }

    public function isSecondOccurence(DateTime $datetime)
    {
        $now = $this->timeProvider->now(true);
        return $now != $datetime->getTimeStamp();
    }

    public function getService()
    {
        return $this->service;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getDateRepetitionString()
    {
        return DateRepetitionInterpeter::dateRepetitionToString($this->dateRepetition);
    }
}



