<?php

declare(strict_types=1);

namespace TimeTracker\Task\Domain\ValueObjects;

use TimeTracker\Common\Domain\ValueObjects\DateTimeValue;

class EndTime extends DateTimeValue
{
    public function value()
    {
        if ($this->value === null) {
            return (new \DateTime())->format('Y-m-d H:i:s');
        }
        return $this->value;
    }
}
