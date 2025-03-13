<?php

declare(strict_types=1);

namespace App\Infrastructure\Delivery\API\MeasurementReading\Handler;

use App\Domain\Entities\FahrenheitMeasurmentStrategy;
use App\Domain\Entities\MeasurementReading;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use App\Domain\Entities\Sensor;
use App\Domain\Entities\Temperature;
use App\Infrastructure\Delivery\API\Form\MeasurementReaddingAddedFormType;
use App\Application\Command\MeasurementReadingCommand;

class MeasurementAddedHandler
{

    private $messageBus;
    private $formFactory;

    public function __construct(MessageBusInterface $messageBus, FormFactoryInterface $formFactory)
    {
        $this->messageBus = $messageBus;
        $this->formFactory = $formFactory;
    }


    public function handle(Request $request): Response
    {
        $requestData = json_decode($request->getContent(), true);

        if (!isset($requestData['reading'])) {
            return new Response('Incorrect format', Response::HTTP_BAD_REQUEST);
        }

        $form = $this->formFactory->create(MeasurementReaddingAddedFormType::class);
        $form->submit($requestData['reading']);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $temperatureObj = new Temperature(new FahrenheitMeasurmentStrategy())
                ->setValue($data["temperature"]);
            $measurementReading = new MeasurementReading(
                $temperatureObj,
                new Sensor(null, $data["sensor_uuid"], null),
            );

            $command = new MeasurementReadingCommand($measurementReading);

            $this->messageBus->dispatch($command);

            return new Response('Measurement added.', Response::HTTP_ACCEPTED);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[] = $error->getMessage();
        }
        $errorsString = implode(", ", $errors);
        return new Response("Invalid request data: " . $errorsString, Response::HTTP_BAD_REQUEST);
    }

}
