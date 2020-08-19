<?php


namespace TimeTracker\Task\Domain\ValueObjects;


class TaskStatus
{
    protected const CREATED = 'created';
    protected const STARTED = 'started';
    protected const STOPPED  = 'stopped';
    protected const DONE  = 'done';

    private $value;

    public function __construct(string $value)
    {
        //FIX: To avoid this dirty logic, we can implement this package https://github.com/spatie/enum
        if (self::STARTED !== $value && self::STOPPED !== $value && self::DONE !== $value  && self::CREATED !== $value) {
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
