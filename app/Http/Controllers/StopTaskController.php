<?php

namespace App\Http\Controllers;

use TimeTracker\Task\Application\Terminator\TaskTerminator;
use TimeTracker\Task\Domain\ValueObjects\TaskId;

class StopTaskController extends Controller
{
    public function __invoke(TaskTerminator $taskTerminator, string $taskId)
    {
        $taskTerminator->__invoke(
            new TaskId($taskId)
        );
    }
}
