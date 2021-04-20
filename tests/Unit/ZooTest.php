<?php
declare(strict_types=1);

namespace App\Tests\Unit;


use App\Domain\Animal\Interfaces\AlligatorInterface;
use App\Domain\Animal\Services\AnimalFactory;
use App\Domain\Space\Services\AlligatorSpace;
use App\Domain\Space\Services\CleaningService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ZooTest extends KernelTestCase
{
    private const SIZE_SPACE = 5;

    private AnimalFactory $animalFactory;

    protected function setUp(): void
    {
        $this->animalFactory = new AnimalFactory();
    }

    public function testCreateInvalidAnimal(): void
    {
        $this->expectExceptionMessage('You can create only these animals: alligator, lion, elephant');
        $this->animalFactory->create('human', 8000000000);
    }

    public function testCreateValidAnimal(): void
    {
        $amountAnimals = 3;
        $animals = $this->animalFactory->create(AnimalFactory::ALLIGATOR, $amountAnimals);

        $this->assertCount($amountAnimals, $animals);
        $this->assertInstanceOf(AlligatorInterface::class, $animals[0]);
    }

    public function testAdoptInvalidAnimalIntoAlligatorSpace(): void
    {
        $lion = $this->animalFactory->create(AnimalFactory::LION)[0];
        $space = $this->createAlligatorSpace();

        $this->expectExceptionMessage('Only for App\Domain\Animal\Interfaces\AlligatorInterface space, given: App\Domain\Animal\Entity\Lion');
        $space->add($lion);
    }

    public function testAdoptValidAnimalIntoAlligatorSpace(): void
    {
        $amountAnimals = self::SIZE_SPACE - 2;
        $alligators = $this->animalFactory->create(AnimalFactory::ALLIGATOR, $amountAnimals);
        $space = $this->createAlligatorSpace();

        $result = [];
        foreach ($alligators as $alligator) {
            $result[] = $space->add($alligator) ? 1 : 0;
        }

        $this->assertEquals($amountAnimals, array_sum($result));
    }

    public function testOutOfRangeSpace(): void
    {
        $amountAnimal = self::SIZE_SPACE + 1;
        $alligators = $this->animalFactory->create(AnimalFactory::ALLIGATOR, $amountAnimal);
        $space = $this->createAlligatorSpace();

        $result = [];
        foreach ($alligators as $alligator) {
            $result[] = $space->add($alligator) ? 1 : 0;
        }

        $this->assertEquals($amountAnimal - 1, array_sum($result));
    }

    public function testAttemptToCleanNonEmptySpace(): void
    {
        $alligator = $this->animalFactory->create(AnimalFactory::ALLIGATOR)[0];
        $space = $this->createAlligatorSpace();
        $space->add($alligator);
        $cleaningService = new CleaningService();

        $this->assertFalse($cleaningService->cleaning($space));
    }

    public function testCleanEmptySpace(): void
    {
        $space = $this->createAlligatorSpace();
        $cleaningService = new CleaningService();

        $this->assertTrue($cleaningService->cleaning($space));
    }

    private function createAlligatorSpace(): AlligatorSpace
    {
        return new AlligatorSpace(self::SIZE_SPACE);
    }
}
