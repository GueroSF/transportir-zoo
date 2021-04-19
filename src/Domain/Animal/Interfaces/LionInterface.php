<?php
declare(strict_types=1);

namespace App\Domain\Animal\Interfaces;


interface LionInterface extends AnimalInterface
{
    public function growl(): void;
}
