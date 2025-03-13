<?php

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Domain\Entities\MeasurementReading;

use Doctrine\ORM\EntityManager;

class MeasurementAddedActionTest extends WebTestCase
{
    private ?EntityManager $entityManager;
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

    }

    public function test_adding_measurement(): void
    {
        $requestData = [
            'reading' => [
                'sensor_uuid' => '456',
                'temperature' => 789
            ]
        ];

        $this->client->request(
            'POST',
            '/api/v1/reading',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($requestData)
        );
        $this->assertResponseIsSuccessful();

        $reading = $this->entityManager
            ->getRepository(MeasurementReading::class)
            ->findOneBy(['sensor_uuid' => '456'])
        ;
        $this->assertEqualsWithDelta(420.55555555556, $reading->temperature_in_celsius, PHP_FLOAT_EPSILON);

    }
}
