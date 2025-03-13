<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Entities\MeasurementReading;
final class MeasurementReadingCommand
{


    public function __construct(
        private MeasurementReading $measurementReading,

    ) {
    }


    public function getMeasurementReading(): MeasurementReading
    {
        return $this->measurementReading;
    }

}
