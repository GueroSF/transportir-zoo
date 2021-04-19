<?php
declare(strict_types=1);

namespace App\Domain\Core\Interfaces;


interface CreatureOfGodInterface
{
    public function eat(CreatureOfGodInterface $eat): void;
}
