<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use TimeTracker\Task\Application\Create\TaskCreator;
use TimeTracker\Task\Domain\ValueObjects\TaskId;
use TimeTracker\Task\Domain\ValueObjects\TaskName;

class GetAllTaskController extends Controller
{
    public function __invoke(TaskFinder $taskFinder)
    {
                ///
    }
}
