<?php

declare(strict_types=1);

namespace TimeTracker\Task\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;
use TimeTracker\Common\Infrastructure\Persistence\Repository;
use TimeTracker\Task\Domain\Task;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\Tasks;
use TimeTracker\Task\Domain\TaskTimeRepository;
use TimeTracker\Task\Domain\TaskTimers;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;


class TaskRepositoryRaw extends Repository implements TaskRepository
{
    protected const TABLE = 'tasks';
    private TaskTimeRepository $taskTimeRepository;

    public function __construct(TaskTimeRepository $taskTimeRepository)
    {
        $this->taskTimeRepository = $taskTimeRepository;
    }

    public function save(Task $task): void
    {
        DB::table(self::TABLE)->insert(
            [
                'id' => $task->id()->value(),
                'name' => $task->name()->value()
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

        $task[0]->task_timers  = $this->taskTimeRepository
            ->findByTaskId(new TaskId($task[0]->id));

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
            $task->task_timers  = $this->taskTimeRepository
                ->findByTaskId(new TaskId($task->id));

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
            isset($task['task_timers'])
                ? $task['task_timers']
                : new TaskTimers()
        );
    }

    public function byName(TaskName $taskName): ?Task
    {
        $task = DB::table(self::TABLE)
            ->where('name', 'LIKE', '%' . $taskName->value() . '%')
            ->get()
            ->toArray();

        if (!$task) {
            return null;
        }

        $task[0]->task_timers  = $this->taskTimeRepository
            ->findByTaskId(new TaskId($task[0]->id));

        return $this
            ->rawToEntity(
                get_object_vars($task[0])
            );
    }
}
