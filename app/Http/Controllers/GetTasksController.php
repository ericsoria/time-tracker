<?php

namespace App\Http\Controllers;

use TimeTracker\Task\Application\Getter\TaskGetter;

class GetTasksController extends Controller
{
    public function __invoke(TaskGetter $taskGetter)
    {
        $response = [];
        $tasks = $taskGetter->__invoke()->map( function($task) {
            return $task->toArray();
            });

        foreach ($tasks as $task) {
            $task['taskTimers'] = $task['taskTimers']->map( function($taskTime) {
                return $taskTime->toArray();
            });
            $date = new \DateTime($task['dateTime']);
            $response[$date->format('Y-m-d')][] = $task;
        }

        return $response;
    }
}
