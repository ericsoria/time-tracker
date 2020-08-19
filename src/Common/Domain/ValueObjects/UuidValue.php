<?php

declare(strict_types=1);

namespace TimeTracker\Common\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;

abstract class UuidValue
{
    private $value;

    public function __construct(string $value)
    {
        $this->checkUuid($value);
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function checkUuid($value)
    {
        if (!Uuid::isValid($value)) {
            throw new \Exception('Id is not valid');
        }
    }
    public function __toString()
    {
        return $this->value();
    }
}
