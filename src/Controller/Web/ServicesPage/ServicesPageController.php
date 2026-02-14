<?php

namespace App\Controller\Web\ServicesPage;

use App\Repository\PageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ServicesPageController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function servicesPage(PageRepository $pageRepository): Response
    {
        $pageData = $pageRepository->findOneBySlugWithActiveBlocksAndPosts('services');

        $servicesHero = null;
        $servicesFormats = null;
        $servicesThemes = null;
        $servicesCta = null;

        if ($blocks = $pageData?->getBlocks()) {
            foreach ($blocks as $block) {
                if ($block->getSlug() === 'services_hero') $servicesHero = $block;
                if ($block->getSlug() === 'services_formats') $servicesFormats = $block;
                if ($block->getSlug() === 'services_themes') $servicesThemes = $block;
                if ($block->getSlug() === 'services_cta') $servicesCta = $block;
            }
        }

        return $this->render('web/services_page/index.html.twig', [
            'active_tab' => 'services_page',
            'services_hero' => $servicesHero,
            'services_formats' => $servicesFormats,
            'services_themes' => $servicesThemes,
            'services_cta' => $servicesCta,
        ]);
    }
}
