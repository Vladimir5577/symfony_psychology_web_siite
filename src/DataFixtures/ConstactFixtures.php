<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConstactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contactsConfig = [
            [
                'name' => 'Phone',
                'slug' => 'phone',
                'contactValue' => '+1 (123) 123-12-12',
                'description' => 'Пн–Пт: 10:00–19:00 (звонки и сообщения). В нерабочие часы перезвоню в первый рабочий день.',
            ],
            [
                'name' => 'Email',
                'slug' => 'email',
                'contactValue' => 'hanna@example.com',
                'description' => 'Отвечаю в течение 1–2 рабочих дней. Для срочных вопросов лучше позвонить.',
            ],
            [
                'name' => 'Facebook',
                'slug' => 'facebook',
                'contactValue' => 'https://facebook.com',
                'description' => null,
            ],
            [
                'name' => 'Instagram',
                'slug' => 'instagram',
                'contactValue' => 'https://instagram.com',
                'description' => null,
            ],
            [
                'name' => 'Telegram',
                'slug' => 'telegram',
                'contactValue' => 'https://t.me',
                'description' => null,
            ],
            [
                'name' => 'WhatsApp',
                'slug' => 'whatsapp',
                'contactValue' => 'https://wa.me/79001234567',
                'description' => null,
            ],
        ];

        foreach ($contactsConfig as $data) {
            $contact = new Contact();
            $contact->setName($data['name']);
            $contact->setSlug($data['slug']);
            $contact->setContactValue($data['contactValue']);
            $contact->setDescription($data['description']);
            $contact->setIsActive(true);
            $manager->persist($contact);
        }

        $manager->flush();
    }
}
