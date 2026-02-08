<?php

namespace App\DataFixtures;

use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pages = [
            ['title' => 'Home page', 'slug' => 'home', 'position' => 0],
            ['title' => 'Blog page', 'slug' => 'blog', 'position' => 1],
            ['title' => 'AboutPageController', 'slug' => 'about', 'position' => 2],
            ['title' => 'Contacts', 'slug' => 'contacts', 'position' => 3],
        ];

        foreach ($pages as $index => $data) {
            $page = new Page();
            $page->setTitle($data['title']);
            $page->setSlug($data['slug']);
            $page->setPosition($data['position']);
            $manager->persist($page);
            if ($index === 0) {
                $this->addReference('page-home', $page);
            }
        }

        $manager->flush();
    }
}
