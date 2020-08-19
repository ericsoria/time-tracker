<?php

declare(strict_types = 1);

namespace TimeTracker\Task\Domain;

interface TaskRepository
{
    public function save(Task $task): void;
}
