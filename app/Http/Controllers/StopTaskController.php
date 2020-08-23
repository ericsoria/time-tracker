<?php

namespace App\Http\Controllers;

use TimeTracker\Task\Application\Terminator\TaskTerminator;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

class StopTaskController extends Controller
{
    public function __invoke(TaskTerminator $taskTerminator, string $taskName)
    {
        $taskTerminator->__invoke(
            new TaskName($taskName)
        );
    }
}
