<?php
declare(strict_types=1);

namespace App\Domain\Animal\Entity;


use App\Domain\Animal\Interfaces\AnimalInterface;
use App\Domain\Core\Interfaces\CreatureOfGodInterface;

abstract class AbstractAnimal implements AnimalInterface
{
    public function eat(CreatureOfGodInterface $eat): void
    {
        // TODO: Implement eat() method.
    }

}
