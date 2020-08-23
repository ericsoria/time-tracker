<?php

declare(strict_types=1);

namespace TimeTracker\Common\Domain\ValueObjects;

abstract class IntValue
{
    protected int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value();
    }
}
