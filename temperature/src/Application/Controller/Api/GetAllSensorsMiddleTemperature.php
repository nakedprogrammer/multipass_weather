<?php

// declare(strict_types=1);

// namespace App\Application\Controller\Api;

// use App\Blog\Post\Article\Application\Model\FindMiddleTemperatureQuery;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Component\Messenger\HandleTrait;
// use Symfony\Component\Messenger\MessageBusInterface;
// use Symfony\Component\Routing\Annotation\Route;

// /**
//  * @Route("", name="", methods={"GET"})
//  */
// final class GetAllSensorsMiddleTemperature extends AbstractController
// {
//     use HandleTrait;

//     public function __construct(MessageBusInterface $messageBus)
//     {
//         $this->messageBus = $messageBus;
//     }

//     public function __invoke(string $id): JsonResponse
//     {
//         $result = $this->handle(new FindMiddleTemperatureQuery($sensor));

//         return JsonResponse::fromJsonString($result);
//     }
// }