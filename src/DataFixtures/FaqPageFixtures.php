<?php

namespace App\DataFixtures;

use App\Entity\Block;
use App\Entity\Page;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FaqPageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $page = new Page();
        $page->setTitle('Частые вопросы');
        $page->setSlug('faq');
        $page->setPosition(7);
        $page->setIsActive(true);
        $manager->persist($page);
        $this->addReference('page-faq', $page);

        $blocksConfig = [
            [
                'title' => 'FAQ hero',
                'slug' => 'faq_hero',
                'description' => 'Hero-блок страницы FAQ.',
                'position' => 0,
                'posts' => [
                    [
                        'title' => 'Частые вопросы',
                        'description' => 'Ответы на типичные вопросы о консультациях, формате работы, оплате и конфиденциальности. Если вашего вопроса нет в списке — напишите или позвоните.',
                        'position' => 0,
                    ],
                ],
            ],
            [
                'title' => 'FAQ items',
                'slug' => 'faq_items',
                'description' => 'Вопросы и ответы (title = вопрос, description = ответ).',
                'position' => 1,
                'posts' => [
                    ['title' => 'Сколько длится одна сессия?', 'description' => 'Стандартная длительность — 50–60 минут. Точное время оговаривается на первой встрече и при необходимости может быть обсуждено снова.', 'position' => 0],
                    ['title' => 'Как часто проходят консультации?', 'description' => 'Чаще всего клиенты выбирают встречи раз в неделю. При необходимости возможна иная частота (например, раз в две недели или интенсивнее в кризисный период) — обсуждается индивидуально.', 'position' => 1],
                    ['title' => 'Всё конфиденциально?', 'description' => 'Да. Содержание консультаций не разглашается. Исключения строго ограничены законом (угроза жизни и т.п.) — о них я говорю на первой встрече. Данные из формы на сайте также не передаются третьим лицам.', 'position' => 2],
                    ['title' => 'Онлайн или очно — что лучше?', 'description' => 'Оба формата эффективны. Онлайн удобен, если вы в другом городе или предпочитаете домашнюю обстановку. Очно подходит тем, кому важнее личный контакт и отдельное пространство. Выбор за вами.', 'position' => 3],
                    ['title' => 'Как оплачиваются консультации?', 'description' => 'Оплата производится до или после сессии — по договорённости. Способы оплаты (карта, перевод и т.д.) обсуждаются при записи. Стоимость одной сессии указана на странице «Стоимость» и уточняется при обращении.', 'position' => 4],
                    ['title' => 'Можно ли отменить или перенести встречу?', 'description' => 'Да. Прошу предупреждать об отмене или переносе не позднее чем за 24 часа. В этом случае мы перенесём сессию без дополнительной оплаты. При отмене в последний момент возможна оплата сессии по договорённости — это обсуждается заранее.', 'position' => 5],
                    ['title' => 'Нужна ли подготовка к первой встрече?', 'description' => 'Специальной подготовки не требуется. Достаточно подумать, с чем вы хотите разобраться в первую очередь. Записать вопросы ко мне тоже можно — на первой встрече для этого есть время.', 'position' => 6],
                    ['title' => 'Вы работаете с детьми / подростками / парами?', 'description' => 'В данном формате я работаю со взрослыми (18+) индивидуально. Если ваш запрос — работа с парой или с ребёнком, могу порекомендовать коллег, кто специализируется на этом.', 'position' => 7],
                    ['title' => 'Ставите ли вы диагнозы? В чём разница с психиатром?', 'description' => 'Психолог не ставит медицинские диагнозы (например, депрессия, тревожное расстройство как диагнозы — это компетенция врача-психиатра). Я работаю с переживаниями, поведением, отношениями; при необходимости рекомендую обратиться к психиатру для диагностики или медикаментозной поддержки. Психиатр — врач, психолог — специалист без медицинского образования, мы можем дополнять друг друга.', 'position' => 8],
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
                $post->setImage($postData['image'] ?? 'default_psychology_1.jpg');
                $post->setIsActive(true);
                $manager->persist($post);
            }
        }

        $manager->flush();
    }
}
