<?php

namespace App\DataFixtures;

use App\Entity\Block;
use App\Entity\Page;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServicesPageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $page = new Page();
        $page->setTitle('Услуги');
        $page->setSlug('services');
        $page->setPosition(5);
        $page->setIsActive(true);
        $manager->persist($page);
        $this->addReference('page-services', $page);

        $blocksConfig = [
            [
                'title' => 'Services hero',
                'slug' => 'services_hero',
                'description' => 'Hero-блок страницы услуг.',
                'position' => 0,
                'posts' => [
                    [
                        'title' => 'Форматы работы',
                        'description' => 'Индивидуальные консультации для взрослых: очно и онлайн. Ниже — описание форматов и тем, с которыми можно обратиться. Стоимость и условия записываются на отдельной странице.',
                        'position' => 0,
                    ],
                ],
            ],
            [
                'title' => 'Services formats',
                'slug' => 'services_formats',
                'description' => 'Форматы: индивидуально, онлайн/очно. У постов может быть image (имя файла в uploads/images).',
                'position' => 1,
                'posts' => [
                    [
                        'title' => 'Индивидуальные консультации',
                        'description' => 'Работа один на один: только вы и психолог. Длительность сессии — 50–60 минут. Частота встреч (обычно раз в неделю) и длительность курса определяются вместе с вами в зависимости от запроса.',
                        'position' => 0,
                        'image' => null,
                    ],
                    [
                        'title' => 'Онлайн-консультации',
                        'description' => 'Сессии по видеосвязи (безопасная платформа). Удобно, если вы в другом городе или предпочитаете не ездить в кабинет. Качество работы сохраняется при соблюдении условий: тихое место, стабильный интернет.',
                        'position' => 1,
                        'image' => null,
                    ],
                    [
                        'title' => 'Очные консультации',
                        'description' => 'Встречи в кабинете. Подходит тем, кому важнее личный контакт и отдельное пространство вне дома. Адрес и условия оговариваются при записи.',
                        'position' => 2,
                        'image' => null,
                    ],
                ],
            ],
            [
                'title' => 'Services themes',
                'slug' => 'services_themes',
                'description' => 'С какими запросами можно обратиться. У постов может быть image.',
                'position' => 2,
                'posts' => [
                    ['title' => 'Тревога и паника', 'description' => 'Генерализованная тревога, панические атаки, навязчивые мысли, хроническое напряжение.', 'position' => 0, 'image' => null],
                    ['title' => 'Стресс и выгорание', 'description' => 'Профессиональное и эмоциональное выгорание, трудности с границами, ощущение «нет сил».', 'position' => 1, 'image' => null],
                    ['title' => 'Отношения и границы', 'description' => 'Сложности в паре, с родственниками, одиночество, зависимые отношения, выстраивание границ.', 'position' => 2, 'image' => null],
                    ['title' => 'Самооценка и кризисы', 'description' => 'Неуверенность, самокритика, выбор пути, экзистенциальные и возрастные кризисы.', 'position' => 3, 'image' => null],
                    ['title' => 'Утрата и горе', 'description' => 'Поддержка в переживании потери, развода, утраты здоровья или значимых опор.', 'position' => 4, 'image' => null],
                ],
            ],
            [
                'title' => 'Services CTA',
                'slug' => 'services_cta',
                'description' => 'Призыв записаться.',
                'position' => 3,
                'posts' => [
                    [
                        'title' => 'Записаться на консультацию',
                        'description' => 'Выберите удобный способ связи на странице «Контакты» или напишите через форму. Я отвечаю в течение 1–2 рабочих дней.',
                        'position' => 0,
                    ],
                ],
            ],
        ];

        $images = ['default_psychology_1.jpg', 'default_psychology_2.jpg'];

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
                $post->setImage($postData['image'] ?? 'default_psychology_1.jpg');
                $post->setIsActive(true);
                $manager->persist($post);
            }
        }

        $manager->flush();
    }
}
