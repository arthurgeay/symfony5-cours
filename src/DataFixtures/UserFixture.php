<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class, 10, function(User $user, $i) {
           $user->setEmail(sprintf('spacebar%d@example.com', $i));
           $user->setFirstName($this->faker->firstName);
        });

        $manager->flush();
    }
}
