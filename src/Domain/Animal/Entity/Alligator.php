<?php
declare(strict_types=1);

namespace App\Domain\Animal\Entity;


use App\Domain\Animal\Interfaces\AlligatorInterface;

class Alligator extends AbstractAnimal implements AlligatorInterface
{
    public function growl(): void
    {
        // TODO: Implement growl() method.
    }

    public function swim(): void
    {
        // TODO: Implement swim() method.
    }
}
