<?php

declare(strict_types=1);

namespace TimeTracker\Task\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;
use TimeTracker\Common\Infrastructure\Persistence\Repository;
use TimeTracker\Task\Application\Finder\TaskTimeFinder;
use TimeTracker\Task\Domain\Task;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\Tasks;
use TimeTracker\Task\Domain\TaskTimers;
use TimeTracker\Task\Domain\ValueObjects\DateTime;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;


class TaskRepositoryRaw extends Repository implements TaskRepository
{
    protected const TABLE = 'tasks';

    public function save(Task $task): void
    {
        DB::table(self::TABLE)->insert(
            [
                'id' => $task->id()->value(),
                'name' => $task->name()->value(),
                'datetime' => $task->dateTime()->value()
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

        $task[0]->task_timers = $this->getTaskTimers($task[0]->id);

        return $this
            ->rawToEntity(
                get_object_vars($task[0])
            );
    }

    public function all(): Tasks
    {
        $tasks = DB::table(self::TABLE)
            ->orderBy('datetime', 'DESC')
            ->get();

        $entities = [];
        foreach ($tasks as $task) {
            $task->task_timers  = $this->getTaskTimers($task->id);

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
            new DateTime($task['datetime']),
            isset($task['task_timers'])
                ? $task['task_timers']
                : new TaskTimers()
        );
    }

    public function byName(TaskName $taskName): ?Task
    {
        $task = DB::table(self::TABLE)
            ->whereRaw('trim(lower(name)) = trim(lower("'.$taskName.'"))')
            ->get()
            ->toArray();

        if (!$task) {
            return null;
        }

        $task[0]->task_timers  = $this->getTaskTimers($task[0]->id);

        return $this
            ->rawToEntity(
                get_object_vars($task[0])
            );
    }
    private function getTaskTimers($taskId)
    {
        $taskTimeFinder = app(TaskTimeFinder::class);
        return $taskTimeFinder
            ->__invoke(new TaskId($taskId));
    }
}
