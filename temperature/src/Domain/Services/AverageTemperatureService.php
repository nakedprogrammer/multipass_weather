<?php

namespace App\Domain\Services;

use App\Domain\Entities\MeasurementReading;

class AverageTemperatureService
{
    public function __construct(
        private array $readings
    ) {
        if ($readings instanceof MeasurementReading) {
            $this->readings[] = $readings;
        }
    }

    public function calculateAverage(): float
    {
        $result = 0;
        $sum = 0;
        foreach ($this->readings as $reading) {
            $sum += $reading->getCelsius();
        }

        $count = count($this->readings);
        if ($count > 0) {
            $result = $sum / $count;
        }

        return $result;
    }


}