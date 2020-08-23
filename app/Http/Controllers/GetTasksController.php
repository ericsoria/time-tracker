<?php

namespace App\Http\Controllers;

use TimeTracker\Task\Application\Getter\TaskGetter;

class GetTasksController extends Controller
{
    public function __invoke(TaskGetter $taskGetter)
    {
        //We can use a DTO to mapper to json response automatically
        return $taskGetter
            ->__invoke()->map( function($item) {
                return $item->toArray();
            });
    }
}
