<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\MeasurementReading;

interface MeasurementReadingRepositoryInterface
{
    public function find(mixed $id, int|\Doctrine\DBAL\LockMode|null $lockMode = null, int|null $lockVersion = null): object|null;

    public function save(MeasurementReading $reading): void;
}