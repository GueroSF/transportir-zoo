<?php
declare(strict_types=1);

namespace App\Domain\Space\Services;


use App\Domain\Space\Interfaces\SpaceInterface;

class CleaningService
{
    public function cleaning(SpaceInterface $space): bool
    {
        return $space->isEmpty();
    }
}
