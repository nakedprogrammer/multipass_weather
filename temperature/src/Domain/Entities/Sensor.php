<?php

namespace App\Domain\Entities;


class Sensor
{

    public function __construct(
        private ?int $id,
        private ?string $uuid,
        private ?string $ip
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public static function create(int $id, string $uuid, string $ip): self
    {
        return new self(
            $id,
            $uuid,
            $ip
        );

    }
}