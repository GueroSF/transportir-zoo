<?php
declare(strict_types=1);

namespace App\Domain\Space\Interfaces;


use App\Domain\Core\Interfaces\CreatureOfGodInterface;

interface SpaceInterface
{
    public function __construct(int $size);

    public function add(CreatureOfGodInterface $creature): bool;

    public function isEmpty(): bool;
}
