<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Command\MeasurementReadingCommand;
use App\Domain\Entities\MeasurementReading;
use App\Domain\Repositories\MeasurementReadingRepositoryInterface;
final class MeasurementReadingHandler
{
    public function __construct(
        private MeasurementReadingRepositoryInterface $measurementReadingRepository
    ) {
    }

    public function __invoke(MeasurementReadingCommand $command)
    {
        $measurementReading = $command->getMeasurementReading();
        if ($measurementReading && $measurementReading instanceof MeasurementReading) {
            $this->measurementReadingRepository->save($measurementReading);
        }

    }

}
