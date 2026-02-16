<?php

namespace App\DataFixtures;

use App\Entity\Block;
use App\Entity\Page;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactsPageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $page = new Page();
        $page->setTitle('Контакты');
        $page->setSlug('contacts');
        $page->setPosition(3);
        $page->setIsActive(true);
        $manager->persist($page);
        $this->addReference('page-contacts', $page);

        $blocksConfig = [
            [
                'title' => 'Contact hero',
                'slug' => 'contact_hero_block',
                'description' => 'Hero-блок страницы контактов: заголовок и вступление.',
                'position' => 0,
                'posts' => [
                    [
                        'title' => 'Связаться со мной',
                        'description' => 'Записаться на консультацию можно по телефону, в мессенджерах (WhatsApp, Telegram) или через форму ниже. Опишите кратко ваш запрос (по желанию) — я отвечу в течение 1–2 рабочих дней и предложу варианты времени для первой встречи. Все данные обрабатываются конфиденциально.',
                        'position' => 0,
                    ],
                ],
            ],
            [
                'title' => 'Contact info',
                'slug' => 'contact_info_block',
                'description' => 'Телефон, email, мессенджеры и часы приёма.',
                'position' => 1,
                'posts' => [
                    [
                        'title' => 'Телефон',
                        'description' => "+7 (XXX) XXX-XX-XX\nПн–Пт: 10:00–19:00 (звонки и сообщения). В нерабочие часы перезвоню в первый рабочий день.",
                        'position' => 0,
                    ],
                    [
                        'title' => 'Email',
                        'description' => "example@example.com\nОтвечаю в течение 1–2 рабочих дней. Для срочных вопросов лучше позвонить.",
                        'position' => 1,
                    ],
                    [
                        'title' => 'Мессенджеры и соцсети',
                        'description' => "Telegram: @your_username\nWhatsApp: по номеру телефона\n(Укажите свои контакты и при необходимости добавьте ссылки на соцсети для информирования о практике.)",
                        'position' => 2,
                    ],
                ],
            ],
            [
                'title' => 'Contact form',
                'slug' => 'contact_form_block',
                'description' => 'Текст над формой обратной связи.',
                'position' => 2,
                'posts' => [
                    [
                        'title' => 'Заявка на консультацию',
                        'description' => "Заполните форму — я свяжусь с вами в течение 1–2 рабочих дней, чтобы согласовать время первой встречи. Укажите удобный способ связи (телефон, email, мессенджер). Всё, что вы напишете, остаётся конфиденциальным и не передаётся третьим лицам.",
                        'position' => 0,
                    ],
                ],
            ],
            [
                'title' => 'Contact reassurance',
                'slug' => 'contact_reassurance_block',
                'description' => 'О конфиденциальности и безопасности данных.',
                'position' => 3,
                'posts' => [
                    [
                        'title' => 'Конфиденциальность',
                        'description' => "Ваша конфиденциальность важна. Данные из формы и переписки не передаются третьим лицам и используются только для связи с вами и организации консультаций. Содержание консультаций не разглашается — об этом я говорю на первой встрече и придерживаюсь этического кодекса психолога.",
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
