<?php


namespace TimeTracker\Task\Domain\ValueObjects;


class TaskStatus
{
    protected const RUNNING = 'running';
    protected const STOPPED  = 'stopped';

    private $value;

    public function __construct(string $value)
    {
        //FIX: To avoid this dirty logic, we can implement this package https://github.com/spatie/enum
        if (self::RUNNING !== $value && self::STOPPED !== $value) {
            throw new \Exception('Status not valid');
        }

        $this->value = $value;
    }
    public function value(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value();
    }

}
