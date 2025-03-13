<?php


namespace App\Application\Controller\Api;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use App\Domain\Form\GetSensorMiddleTemperatureType;

/**
 * @Route("/api/sensor/{id}/middletemperature/{hour}", name="api_sensor_middle_temperature_by_hour", methods={"GET"})
 */
final class GetSensorMiddleTemperature extends AbstractController
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        //private $sensorMiddleTemperatureService
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {

        $form = $this->formFactory->create(GetSensorMiddleTemperatureType::class);
        $form->submit(json_decode($request->getContent(), true));

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            try {
                $result = $this->sensorMiddleTemperatureService->getMeasurements($data['uuid'], $data['time']);
            } catch (\Exception $e) {
            }

            return JsonResponse::fromJsonString($result);
        }

        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $errors[] = $error->getMessage();
        }
        $errorsString = implode(", ", $errors);
        return JsonResponse::fromJsonString(json_encode(["error" => "Invalid request data: " . $errorsString]), JsonResponse::HTTP_BAD_REQUEST);
    }
}