<?php

declare(strict_types=1);

namespace TimeTracker\Task\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;
use TimeTracker\Task\Domain\Task;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\Tasks;
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
                'id' => $task->id()->value(),
                'name' => $task->name()->value(),
                'start_time' => $task->startTime()->value(),
                'end_time' => $task->endTime()->value(),
                'status' => $task->status()->value(),
            ]
        );
    }

    public function find(TaskId $id): ?Task
    {
        $task = DB::table(self::TABLE)
            ->where('id', $id->value())
            ->get()
            ->toArray();

        if (!$task) {
            return null;
        }

        return $this
            ->rawToEntity(
                get_object_vars($task[0])
            );
    }

    public function all(): Tasks
    {
        $tasks = DB::table(self::TABLE)
            ->get();

        $entities = [];
        foreach ($tasks as $task) {
            $entities[] = $this->rawToEntity(
                get_object_vars($task)
            );
        }

        return new Tasks($entities);
    }

    private function rawToEntity(array $task): Task
    {
        return new Task(
            new TaskId($task['id']),
            new TaskName($task['name']),
            new StartTime($task['start_time']),
            new EndTime($task['end_time']),
            new TaskStatus($task['status'])
        );
    }
}
