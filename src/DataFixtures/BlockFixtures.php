<?php

namespace App\DataFixtures;

use App\Entity\Block;
use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BlockFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $homePage = $this->getReference('page-home', Page::class);

        $blocks = [
            ['title' => 'Hero', 'slug' => 'hero', 'description' => 'Главный баннер на главной странице.', 'position' => 0],
            ['title' => 'Marketing row', 'slug' => 'marketing_block_row', 'description' => 'Блок с описанием услуг.', 'position' => 1],
            ['title' => 'Marketing featurette', 'slug' => 'marketing_block_featurette', 'description' => 'Краткое описание для главной страницы.', 'position' => 2],
        ];

        foreach ($blocks as $data) {
            $block = new Block();
            $block->setPage($homePage);
            $block->setTitle($data['title']);
            if (isset($data['slug'])) {
                $block->setSlug($data['slug']);
            }
            $block->setDescription($data['description']);
            $block->setPosition($data['position']);
            $block->setIsActive(true);
            $manager->persist($block);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PageFixtures::class,
        ];
    }
}
