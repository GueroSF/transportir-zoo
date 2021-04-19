<?php
declare(strict_types=1);

namespace App\Domain\Animal\Interfaces;


interface ElephantInterface extends AnimalInterface
{
    public function drench(): bool;
}
