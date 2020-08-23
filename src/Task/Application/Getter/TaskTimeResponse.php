<?php


namespace TimeTracker\Task\Application\Getter;


class TaskTimeResponse
{
    private string $id;
    private string $taskId;
    private string $dateTime;
    private string $startTime;
    private string $endTime;
    private string $status;
    private string $elapsedTime;

    public function __construct(
        string $id,
        string $taskId,
        string $dateTime,
        string $startTime,
        string $endTime,
        string $status,
        string $elapsedTime
    )
    {
        $this->id = $id;
        $this->taskId = $taskId;
        $this->dateTime = $dateTime;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->status = $status;
        $this->elapsedTime = $elapsedTime;
    }

    public function Id(): string
    {
        return $this->id;
    }

    public function taskId(): string
    {
        return $this->taskId;
    }

    public function dateTime(): string
    {
        return $this->dateTime;
    }

    public function startTime(): string
    {
        return $this->startTime;
    }

    public function endTime(): string
    {
        return $this->endTime;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function elapsedTime(): string
    {
        return $this->elapsedTime;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'task_id' => $this->taskId(),
            'dateTime' => $this->dateTime(),
            'startTime' => $this->startTime(),
            'endTime' => $this->endTime(),
            'status' => $this->status(),
            'elapsedTime' => $this->elapsedTime()
        ];
    }
}

