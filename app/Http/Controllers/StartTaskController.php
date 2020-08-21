<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use TimeTracker\Task\Application\Create\TaskCreator;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

class StartTaskController extends Controller
{
    public function __invoke(TaskCreator $taskCreator, Request $request)
    {
        /**
         * We can apply cqrs sending a command/query(DTO) to bus and mapping value objects on handler
         * https://github.com/thephpleague/tactician
         */

        $taskCreator->create(
            new TaskId(Str::Uuid()),
            new TaskName($request->name)
        );
    }
}
