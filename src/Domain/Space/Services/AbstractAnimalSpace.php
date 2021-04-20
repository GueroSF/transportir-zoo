<?php
declare(strict_types=1);

namespace App\Domain\Space\Services;


use App\Domain\Core\Interfaces\CreatureOfGodInterface;
use App\Domain\Space\Exceptions\SpaceException;
use App\Domain\Space\Interfaces\SpaceInterface;

abstract class AbstractAnimalSpace implements SpaceInterface
{
    private \SplFixedArray $holder;

    public function __construct(int $size)
    {
        $this->holder = new \SplFixedArray($size);
    }

    abstract protected function getClassAnimal(): string;

    public function add(CreatureOfGodInterface $animal): bool
    {
        $className = $this->getClassAnimal();
        if (!$animal instanceof $className) {
            throw new SpaceException(
                sprintf('Only for %s space, given: %s', $className, $animal::class)
            );
        }

        $count = $this->countNotEmptyCell();
        if ($count >= $this->holder->getSize()) {
            return false;
        }

        $this->holder[$count] = $animal;

        return true;
    }

    public function isEmpty(): bool
    {
        return $this->countNotEmptyCell() === 0;
    }

    private function countNotEmptyCell(): int
    {
        return count(array_filter((array)$this->holder, fn($cell) => null !== $cell));
    }
}
