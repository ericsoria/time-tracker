<?php

namespace Tests\Unit\Task;

use Mockery;
use Tests\TestCase;
use TimeTracker\Task\Application\Create\TaskCreator;
use TimeTracker\Task\Domain\Task;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\TaskTime;
use TimeTracker\Task\Domain\TaskTimeRepository;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;


class TaskTestCase extends TestCase
{

    private  $taskRepository;
    private  $taskTimeRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->taskRepository = Mockery::mock(TaskRepository::class);
        $this->app->instance(TaskCreator::class, $this->taskRepository);

        $this->taskTimeRepository = Mockery::mock(TaskTimeRepository::class);
    }
    public function taskRepository()
    {
        return $this->taskRepository;
    }

    public function taskTimeRepository()
    {
        return $this->taskTimeRepository;
    }

    public function shouldSearchATask()
    {
        $this->taskRepository()
            ->shouldReceive('byName')
            ->with(TaskName::class)
            ->once()
            ->andReturnNull();
    }

    public function shouldFindATask(TaskId $taskId)
    {
        $this->taskRepository()
            ->shouldReceive('find')
            ->with($taskId)
            ->once();
    }

    public function shouldSaveATask()
    {
        $this->taskRepository()
            ->shouldReceive('save')
            ->with(Task::class)
            ->once()
            ->andReturnNull();
    }
    public function shouldSaveATaskTimes()
    {
        $this->taskTimeRepository()
            ->shouldReceive('save')
            ->with(TaskTime::class)
            ->once()
            ->andReturnNull();
    }

}
