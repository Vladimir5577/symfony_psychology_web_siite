<?php

namespace App\Controller\Web\ContactPage;

use App\Repository\ContactRepository;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactPageControler extends AbstractController
{
    public function __construct(
        private readonly ContactRepository $contactRepository,
        private readonly PageRepository $pageRepository,
    ) {
    }

    #[Route('/contacts', name: 'app_contacts')]
    public function homePage(): Response
    {
        $page = $this->pageRepository->findOneBySlugWithActiveBlocksAndPosts('contacts');
        $contactHeroBlock = null;
        $contactInfoBlock = null;
        $contactFormBlock = null;
        $contactReassuranceBlock = null;

        if ($blocks = $page?->getBlocks()) {
            foreach ($blocks as $block) {
                if ($block->getSlug() === 'contact_hero_block') $contactHeroBlock = $block;
                if ($block->getSlug() === 'contact_info_block') $contactInfoBlock = $block;
                if ($block->getSlug() === 'contact_form_block') $contactFormBlock = $block;
                if ($block->getSlug() === 'contact_reassurance_block') $contactReassuranceBlock = $block;
            }
        }

        $contacts = $this->contactRepository->findAllActiveIndexedBySlug();

        return $this->render('web/contacts_page/index.html.twig', [
            'active_tab' => 'contacts_page',
            'contact_hero_block' => $contactHeroBlock,
            'contact_info_block' => $contactInfoBlock,
            'contact_form_block' => $contactFormBlock,
            'contact_reassurance_block' => $contactReassuranceBlock,
            'contacts' => $contacts,
        ]);
    }
}
