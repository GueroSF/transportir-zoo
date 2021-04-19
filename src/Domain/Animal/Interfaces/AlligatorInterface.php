<?php
declare(strict_types=1);

namespace App\Domain\Animal\Interfaces;


interface AlligatorInterface extends AnimalInterface
{
    public function growl(): void;

    public function swim(): void;
}
