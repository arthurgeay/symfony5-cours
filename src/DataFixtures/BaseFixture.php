<?php


namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{
    /**
     * @var ObjectManager
     */
    private $manager;
    /**
     * @var Generator
     */
    protected $faker;

    private $referencesIndex = [];

    public function load(ObjectManager $manager) {
        $this->manager = $manager;
        $this->faker = Factory::create();
        $this->loadData($manager);
    }

    abstract protected function loadData(ObjectManager $manager);

    protected function createMany(string $className, int $count, callable $factory)
    {
        for($i = 0; $i < $count; $i++) {
            $entity = new $className();
            $factory($entity, $i);

            $this->manager->persist($entity);
            $this->addReference($className . '_' . $i, $entity);
        }
    }

    protected function getRandomReference(string $className)
    {
        if(!isset($this->referencesIndex[$className])) {
            $this->referencesIndex[$className] = [];

            foreach($this->referenceRepository->getReferences() as $key => $ref) {
                if(strpos($key, $className.'_') === 0) {
                    $this->referencesIndex[$className][] = $key;
                }
            }
        }

        if(empty($this->referencesIndex[$className])) {
            throw new \Exception(sprintf('Impossible de trouver une référence pour la classe %s', $className));
        }

        $randomReferenceKey = $this->faker->randomElement($this->referencesIndex[$className]);

        return $this->getReference($randomReferenceKey);
    }
}