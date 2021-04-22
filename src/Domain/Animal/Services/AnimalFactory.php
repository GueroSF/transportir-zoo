<?php
declare(strict_types=1);

namespace App\Domain\Animal\Services;


use App\Domain\Animal\Entity\Alligator;
use App\Domain\Animal\Entity\Elephant;
use App\Domain\Animal\Entity\Lion;
use App\Domain\Animal\Exceptions\AnimalException;
use App\Domain\Animal\Interfaces\AnimalInterface;

class AnimalFactory
{
    public const ALLIGATOR = 'alligator';
    public const LION = 'lion';
    public const ELEPHANT = 'elephant';

    private const AVAILABLE_ANIMALS = [
        self::ALLIGATOR,
        self::LION,
        self::ELEPHANT,
    ];

    /**
     * @return \SplFixedArray<AnimalInterface>
     */
    public function create(string $animal, int $count = 1): \SplFixedArray
    {
        $class = match ($animal) {
            self::ALLIGATOR => Alligator::class,
            self::LION => Lion::class,
            self::ELEPHANT => Elephant::class,
            default => null,
        };

        if (null === $class) {
            throw new AnimalException(
                sprintf('You can create only these animals: %s', implode(', ', self::AVAILABLE_ANIMALS))
            );
        }

        $ark = new \SplFixedArray($count);

        foreach ($ark as $index => $item) {
            $ark[$index] = new $class;
        }

        return $ark;
    }
}
