<?php
declare(strict_types=1);

namespace App\Domain\Animal\Entity;


use App\Domain\Animal\Interfaces\ElephantInterface;

class Elephant extends AbstractAnimal implements ElephantInterface
{
    public function drench(): bool
    {
        return true;
    }

}
