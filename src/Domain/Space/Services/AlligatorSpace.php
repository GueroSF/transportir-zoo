<?php
declare(strict_types=1);

namespace App\Domain\Space\Services;


use App\Domain\Animal\Interfaces\AlligatorInterface;

class AlligatorSpace extends AbstractAnimalSpace
{
    protected function getClassAnimal(): string
    {
        return AlligatorInterface::class;
    }
}
