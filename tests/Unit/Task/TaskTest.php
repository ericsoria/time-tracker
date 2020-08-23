<?php

namespace Tests\Unit\Task;

use Illuminate\Support\Str;
use \Exception;
use TimeTracker\Task\Application\Create\TaskCreator;
use TimeTracker\Task\Application\Create\TaskTimeCreator;
use TimeTracker\Task\Application\Finder\TaskFinder;
use TimeTracker\Task\Application\Searcher\TaskSearcher;
use TimeTracker\Task\Application\Terminator\TaskTerminator;
use TimeTracker\Task\Domain\ValueObjects\DateTime;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

class TaskTest extends TaskTestCase
{

    private TaskSearcher $taskSearcher;
    private TaskTimeCreator $taskTimeCreator;
    private TaskCreator $taskCreator;
    private TaskFinder $taskFinder;

    public function setUp(): void
    {
        parent::setUp();
        $this->taskSearcher = new TaskSearcher($this->taskRepository());
        $this->taskFinder = new TaskFinder($this->taskRepository());
        $this->taskTimeCreator = new TaskTimeCreator($this->taskTimeRepository(), $this->taskFinder);
    }

    /** @test */
    public function it_should_start_a_task()
    {
        $taskId = new TaskId(Str::uuid()->toString());
        $taskCreator = new TaskCreator($this->taskRepository(), $this->taskSearcher, $this->taskTimeCreator);

        $this->shouldSearchATask();
        $this->shouldSaveATask();
        $this->shouldSaveATaskTimes();

        $taskCreator->create(
            $taskId,
            new TaskName('test'),
            new DateTime('2020-08-23 21:09:00')
        );
    }

    /** @test */
    public function it_should_stop_a_task()
    {
        $taskTerminator = new TaskTerminator($this->taskSearcher, $this->taskTimeRepository());
        $this->expectException(Exception::class);
        $this->shouldSearchATask();
        $taskTerminator->__invoke(new TaskName('TEST'));
    }
}
