<?php

declare(strict_types=1);

namespace TimeTracker\Task\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;

use TimeTracker\Common\Infrastructure\Persistence\Repository;
use TimeTracker\Task\Domain\TaskTime;
use TimeTracker\Task\Domain\TaskTimeRepository;
use TimeTracker\Task\Domain\TaskTimers;
use TimeTracker\Task\Domain\ValueObjects\EndTime;
use TimeTracker\Task\Domain\ValueObjects\StartTime;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskStatus;
use TimeTracker\Task\Domain\ValueObjects\TaskTimeId;

class TaskTimeRepositoryRaw extends Repository implements TaskTimeRepository
{
    protected const TABLE = 'task_times';

    public function save(TaskTime $taskTime): void
    {
        DB::table(self::TABLE)->insert(
            [
                'id' => $taskTime->id()->value(),
                'task_id' => $taskTime->taskId()->value(),
                'start_time' => $taskTime->startTime()->value(),
                'end_time' => $taskTime->endTime()->value(),
                'status' => $taskTime->status()->value()
            ]
        );
    }

    public function findByTaskId(TaskId $taskId): TaskTimers
    {
        $tasks = DB::table(self::TABLE)
            ->where('task_id', $taskId->value())
            ->get()
            ->toArray();

        $taskTimers = [];
        foreach ($tasks as $task) {
            $taskTimers[] = $this
                ->rawToEntity(
                    get_object_vars($task)
                );
        }

        return new TaskTimers($taskTimers);
    }

    private function rawToEntity(array $task): TaskTime
    {
        return new TaskTime(
            new TaskTimeId($task['id']),
            new TaskId($task['task_id']),
            new StartTime($task['start_time']),
            new EndTime($task['end_time']),
            new TaskStatus($task['status'])
        );
    }
}
