<?php

declare(strict_types=1);

namespace TimeTracker\Task\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;
use TimeTracker\Task\Domain\Task;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\ValueObjects\EndDate;
use TimeTracker\Task\Domain\ValueObjects\EndTime;
use TimeTracker\Task\Domain\ValueObjects\StartDate;
use TimeTracker\Task\Domain\ValueObjects\StartTime;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;
use TimeTracker\Task\Domain\ValueObjects\TaskStatus;

class TaskRepositoryRaw implements TaskRepository
{
    protected const TABLE = 'tasks';

    public function save(Task $task): void
    {
        DB::table(self::TABLE)->insert(
            [
                'id' => $task->id(),
                'name' => $task->name(),
                'start_time' => $task->startTime(),
                'end_time' => $task->endTime(),
                'status' => $task->status(),
            ]
        );
    }

    public function find(TaskId $id): ?Task
    {
        $task = DB::table(self::TABLE)
            ->where('id', $id->value())
            ->first();

        if (!$task) {
            return null;
        }

        return new Task(
            new TaskId($task['id']),
            new TaskName($task['name']),
            new StartTime($task['start_time']),
            new EndTime($task['end_time']),
            new TaskStatus($task['status'])
        );
    }
}
