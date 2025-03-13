<?php

namespace App\Domain\Entities;

interface InterfaceMeasurementStrategy
{
    public function normalize(float $value): float;
}
class FahrenheitMeasurmentStrategy implements InterfaceMeasurementStrategy
{
    public function normalize(float $value): float
    {
        return ($value - 32) * 5 / 9;
    }
}

class Temperature
{
    private float $value;
    public float $fahrenheit;
    public float $celisius;

    public function __construct(
        private ?InterfaceMeasurementStrategy $measurementStrategy
    ) {
    }

    public function setValue(float $value): static
    {
        if ($this->measurementStrategy) {
            $value = $this->measurementStrategy->normalize($value);
        }

        $this->value = $value;
        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getCelsius(): float
    {
        return $this->value;
    }

    public function getFahrenheit(): float
    {
        return $this->value * 9 / 5 + 32;
    }

}
