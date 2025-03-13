<?php

declare(strict_types=1);

namespace App\Infrastructure\Delivery\API\MeasurementReading;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Infrastructure\Delivery\API\MeasurementReading\Handler\MeasurementAddedHandler;

final class MeasurementAddedAction
{

    private $measurementAddedHandler;

    public function __construct(MeasurementAddedHandler $handler)
    {
        $this->measurementAddedHandler = $handler;
    }

    /**
     * @Route("/api/v1/measurement", name="measurement_add", methods={"POST"})
     */
    public function __invoke(Request $request): Response
    {
        return $this->measurementAddedHandler->handle($request);
    }

}

