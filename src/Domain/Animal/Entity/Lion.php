<?php
declare(strict_types=1);

namespace App\Domain\Animal\Entity;


use App\Domain\Animal\Interfaces\LionInterface;

class Lion extends AbstractAnimal implements LionInterface
{
    public function growl(): void
    {
        // TODO: Implement growl() method.
    }

}
