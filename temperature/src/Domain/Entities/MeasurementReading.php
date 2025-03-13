<?php

namespace App\Domain\Entities;

use App\Domain\Entities\Sensor;
use App\Domain\Entities\Temperature;

class MeasurementReading
{
    public $id;
    public string $sensor_uuid;
    public string $temperature_in_celsius;

    public \DateTimeImmutable $created_at;
    public \DateTimeImmutable $updated_at;

    public function __construct(
        private Temperature $temperature,
        private Sensor $sensor
    ) {

        $this->created_at = new \DateTimeImmutable('now');
        $this->updated_at = new \DateTimeImmutable('now');

        $this->sensor_uuid = $sensor->getUuid();
        $this->temperature_in_celsius = $temperature->getCelsius();
    }

    public function __set($property, $value)
    {
        if (property_exists($this, 'updated_at')) {
            $this->updated_at = new \DateTimeImmutable('now');
        }
    }

}