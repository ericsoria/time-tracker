<?php

namespace App\Http\Controllers;

use TimeTracker\Task\Application\Finder\TaskFinder;
use TimeTracker\Task\Domain\ValueObjects\TaskId;

class FindTaskController extends Controller
{
    public function __invoke(TaskFinder $taskFinder, $taskId)
    {
        return $taskFinder
            ->__invoke(
                new TaskId($taskId)
            )->toArray();
    }
}
