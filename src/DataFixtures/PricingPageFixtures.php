<?php

namespace App\DataFixtures;

use App\Entity\Block;
use App\Entity\Page;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PricingPageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $page = new Page();
        $page->setTitle('Стоимость');
        $page->setSlug('pricing');
        $page->setPosition(6);
        $page->setIsActive(true);
        $manager->persist($page);
        $this->addReference('page-pricing', $page);

        $blocksConfig = [
            [
                'title' => 'Pricing hero',
                'slug' => 'pricing_hero',
                'description' => 'Hero-блок страницы стоимости.',
                'position' => 0,
                'posts' => [
                    [
                        'title' => 'Стоимость консультаций',
                        'description' => 'Ниже — ориентировочные тарифы и правила оплаты, отмены и переноса. Точную стоимость одной сессии уточняйте при записи.',
                        'position' => 0,
                    ],
                ],
            ],
            [
                'title' => 'Pricing rates',
                'slug' => 'pricing_rates',
                'description' => 'Тарифные карточки. У каждого поста: title = название плана, description = первая строка цена (например «3 000 ₽ / за сессию»), далее с новой строки — пункты списка.',
                'position' => 1,
                'posts' => [
                    [
                        'title' => 'Одна сессия',
                        'description' => "3 000 ₽ / за сессию\n50–60 минут\nОчно или онлайн\nОплата до или после встречи",
                        'position' => 0,
                    ],
                    [
                        'title' => 'Пакет 5 сессий',
                        'description' => "14 000 ₽\n5 сессий по 50–60 мин\nЭкономия 1 000 ₽\nОчно или онлайн",
                        'position' => 1,
                    ],
                    [
                        'title' => 'Пакет 10 сессий',
                        'description' => "27 000 ₽\n10 сессий по 50–60 мин\nЭкономия 3 000 ₽\nОчно или онлайн",
                        'position' => 2,
                    ],
                ],
            ],
            [
                'title' => 'Pricing rules',
                'slug' => 'pricing_rules',
                'description' => 'Правила оплаты, отмены, переноса.',
                'position' => 2,
                'posts' => [
                    [
                        'title' => 'Оплата',
                        'description' => 'Способы оплаты: банковская карта, перевод по реквизитам (уточняйте при записи). Оплата производится до или после сессии по договорённости.',
                        'position' => 0,
                    ],
                    [
                        'title' => 'Отмена и перенос',
                        'description' => 'Прошу предупреждать об отмене или переносе не позднее чем за 24 часа до встречи. В этом случае мы перенесём сессию без дополнительной оплаты. При отмене в последний момент (менее чем за 24 часа) сессия может считаться проведённой и оплачивается — этот момент обсуждается при первой встрече.',
                        'position' => 1,
                    ],
                ],
            ],
            [
                'title' => 'Pricing CTA',
                'slug' => 'pricing_cta',
                'description' => 'Призыв записаться.',
                'position' => 3,
                'posts' => [
                    [
                        'title' => 'Записаться и уточнить стоимость',
                        'description' => 'Напишите или позвоните — назову актуальную стоимость сессии и предложу варианты времени для первой консультации.',
                        'position' => 0,
                    ],
                ],
            ],
        ];

        foreach ($blocksConfig as $data) {
            $block = new Block();
            $block->setPage($page);
            $block->setTitle($data['title']);
            $block->setSlug($data['slug']);
            $block->setDescription($data['description']);
            $block->setPosition($data['position']);
            $block->setIsActive(true);
            $manager->persist($block);

            foreach ($data['posts'] as $postData) {
                $post = new Post();
                $post->setBlock($block);
                $post->setTitle($postData['title']);
                $post->setDescription($postData['description']);
                $post->setPosition($postData['position']);
                $post->setIsActive(true);
                $manager->persist($post);
            }
        }

        $manager->flush();
    }
}
