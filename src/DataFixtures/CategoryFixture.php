<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName('Category'.$i);
            $category->setCreatedAt();
            $manager->persist($category);
        }

        $manager->flush();
    }
}
