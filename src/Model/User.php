<?php

declare(strict_types=1);

namespace App\Model;

use Sylius\Component\Resource\Metadata\Index;
use Sylius\Component\Resource\Metadata\Resource;
use Sylius\Component\Resource\Metadata\Show;
use Sylius\Component\Resource\Model\ResourceInterface;

#[Resource()]
#[Index(grid: "App\Grid\UserGrid")]
#[Show(provider: "App\Grid\Provider\UserProvider")]
final class User implements ResourceInterface
{
    public function __construct(
        public readonly int $id,
        public readonly Gender $gender,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $bloodGroup,
        public readonly int $height,
        public readonly string $image,
        public readonly string $phone,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return trim($this->firstName . ' ' . $this->lastName);
    }
}
