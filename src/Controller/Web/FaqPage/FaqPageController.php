<?php

namespace App\Controller\Web\FaqPage;

use App\Repository\PageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FaqPageController extends AbstractController
{
    #[Route('/faq', name: 'app_faq')]
    public function faqPage(PageRepository $pageRepository): Response
    {
        $pageData = $pageRepository->findOneBySlugWithActiveBlocksAndPosts('faq');

        $faqHero = null;
        $faqItems = null;

        if ($blocks = $pageData?->getBlocks()) {
            foreach ($blocks as $block) {
                if ($block->getSlug() === 'faq_hero') $faqHero = $block;
                if ($block->getSlug() === 'faq_items') $faqItems = $block;
            }
        }

        return $this->render('web/faq_page/index.html.twig', [
            'active_tab' => 'faq_page',
            'faq_hero' => $faqHero,
            'faq_items' => $faqItems,
        ]);
    }
}
