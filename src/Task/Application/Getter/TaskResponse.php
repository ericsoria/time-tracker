<?php

namespace TimeTracker\Task\Application\Getter;

class TaskResponse
{
    private string $id;
    private string $name;
    private string $dateTime;
    private $taskTimers;
    private string $totalTime;

    public function __construct(string $id, string $name, string $dateTime, $taskTimers, string $totalTime)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dateTime = $dateTime;
        $this->taskTimers = $taskTimers;
        $this->totalTime = $totalTime;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function dateTime(): string
    {
        return $this->dateTime;
    }

    public function taskTimers()
    {
        return $this->taskTimers;
    }

    public function totalTime(): string
    {
        return $this->totalTime;
    }

    public function toArray()
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'dateTime' => $this->dateTime(),
            'taskTimers' => $this->taskTimers(),
            'totalTime' => $this->totalTime()
        ];
    }
}

