<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Command\MeasurementReadingCommand;
use App\Domain\Entities\MeasurementReading;
use App\Domain\Repositories\MeasurementReadingRepositoryInterface;
final class MeasurementReadingHandler
{
    private measurementReadingRepositoryInterface $userInterface;

    public function __construct(private MeasurementReadingRepositoryInterface $measurementReadingRepository)
    {
        $this->measurementReadingRepository = $measurementReadingRepository;


    }

    public function __invoke(MeasurementReadingCommand $command)
    {
        $measurementReading = $command->getMeasurementReading();
        if ($measurementReading && $measurementReading instanceof MeasurementReading) {
            $this->measurementReadingRepository->save($measurementReading);
        }

    }
    // public function __invoke(RegisterUserCommand $command)
    // {
    //     $user = new User();
    //     $user->setEmail($command->getEmail());
    //     $user->setFirstname($command->getFirstname());
    //     $user->setLastname($command->getLastName()); 
    //     $user->setNationality($command->getNationality());
    //     $hashedPassword = $this->passwordHasher->hashPassword($user, $command->getPassword());
    //     $user->setPassword($hashedPassword);

    //     $this->userInterface->create($user);
    // }
}
