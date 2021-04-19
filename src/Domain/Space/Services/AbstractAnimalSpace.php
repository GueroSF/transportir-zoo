<?php
declare(strict_types=1);

namespace App\Domain\Space\Services;


use App\Domain\Core\Interfaces\CreatureOfGodInterface;
use App\Domain\Space\Exceptions\SpaceException;
use App\Domain\Space\Interfaces\SpaceInterface;

abstract class AbstractAnimalSpace implements SpaceInterface
{
    private int $size;
    private \SplFixedArray $holder;

    public function __construct(int $size)
    {
        $this->size = $size;
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

        $count = $this->holder->count();
        if ($count > $this->size) {
            return false;
        }

        $this->holder[++$count] = $animal;

        return true;
    }

    public function moveTo(SpaceInterface $space): void
    {
        if (!$space instanceof static) {
            throw new SpaceException(
                sprintf(
                    'Expected space for %s, given %s',
                    static::class,
                    $space::class
                )
            );
        }

        foreach ($this->holder->toArray() as $animal) {
            $space->add($animal);
        }
    }

    public function isEmpty(): bool
    {
        return $this->holder->count() === 0;
    }
}
