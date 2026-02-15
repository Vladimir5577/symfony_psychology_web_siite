<?php

namespace App\DataFixtures;

use App\Entity\Block;
use App\Entity\Page;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogPageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $page = new Page();
        $page->setTitle('Блог');
        $page->setSlug('blog');
        $page->setPosition(4);
        $page->setIsActive(true);
        $manager->persist($page);
        $this->addReference('page-blog', $page);

        $blocksConfig = [
            [
                'title' => 'Blog hero',
                'slug' => 'blog_hero',
                'description' => 'Hero-блок страницы блога.',
                'position' => 0,
                'posts' => [
                    [
                        'title' => 'Блог',
                        'description' => 'Статьи о психологии, саморазвитии и практические заметки. Здесь я делюсь мыслями о тревоге, стрессе, отношениях и способах находить опору.',
                        'position' => 0,
                    ],
                ],
            ],
            [
                'title' => 'Blog intro',
                'slug' => 'blog_intro',
                'description' => 'Краткое вступление к разделу статей.',
                'position' => 1,
                'posts' => [
                    [
                        'title' => 'О чём этот раздел',
                        'description' => 'В блоге публикуются материалы образовательного характера: не замена консультации, а возможность чуть лучше разобраться в темах, которые часто поднимают клиенты. Новые статьи появляются по мере возможности.',
                        'position' => 0,
                    ],
                ],
            ],
            [
                'title' => 'Blog posts',
                'slug' => 'blog_posts',
                'description' => 'Список записей блога (заголовок = название статьи, description = краткое описание, image = имя файла в uploads/images или null).',
                'position' => 2,
                'posts' => [
                    [
                        'title' => 'Что такое первая консультация и зачем она нужна',
                        'description' => 'На первой встрече мы знакомимся, вы рассказываете о запросе, я отвечаю на вопросы о формате работы. Разбираем, чего ожидать и как строится дальнейшая работа.',
                        'position' => 0,
                        'image' => null,
                    ],
                    [
                        'title' => 'Тревога: когда она нормальна, а когда стоит обратиться',
                        'description' => 'Кратко о том, чем тревога отличается от страха, когда она в пределах нормы и в каких случаях имеет смысл идти к психологу или психиатру.',
                        'position' => 1,
                        'image' => null,
                    ],
                    [
                        'title' => 'Конфиденциальность в терапии: что это значит на практике',
                        'description' => 'Что остаётся между вами и психологом, какие исключения бывают по закону и почему конфиденциальность — основа доверия в работе.',
                        'position' => 2,
                        'image' => null,
                    ],
                    [
                        'title' => 'Стресс и выгорание: как распознать и что делать',
                        'description' => 'Признаки хронического стресса и выгорания, отличия от обычной усталости. Практические шаги для профилактики и восстановления.',
                        'position' => 3,
                        'image' => null,
                    ],
                    [
                        'title' => 'Работа с границами в отношениях',
                        'description' => 'Почему трудно говорить «нет», как устанавливать границы без чувства вины и что делать, когда близкие на них реагируют болезненно.',
                        'position' => 4,
                        'image' => null,
                    ],
                    [
                        'title' => 'Сон и психическое здоровье',
                        'description' => 'Связь сна с тревогой и настроением. Простые правила гигиены сна и когда нарушения сна — повод обратиться к специалисту.',
                        'position' => 5,
                        'image' => null,
                    ],
                    [
                        'title' => 'Как выбрать психолога или психотерапевта',
                        'description' => 'На что обращать внимание при поиске специалиста: образование, подход, первая встреча и личный комфорт в контакте.',
                        'position' => 6,
                        'image' => null,
                    ],
                    [
                        'title' => 'Самокритика и внутренний критик',
                        'description' => 'Откуда берётся жёсткая самокритика, чем она отличается от здоровой рефлексии и как с ней работать в терапии.',
                        'position' => 7,
                        'image' => null,
                    ],
                    [
                        'title' => 'Прокрастинация: что за ней стоит',
                        'description' => 'Прокрастинация часто связана с тревогой, страхом оценки или перфекционизмом. Разбираем возможные причины и пути помощи.',
                        'position' => 8,
                        'image' => null,
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
                $post->setImage($postData['image'] ?? null);
                $post->setIsActive(true);
                $manager->persist($post);
            }
        }

        $manager->flush();
    }
}
