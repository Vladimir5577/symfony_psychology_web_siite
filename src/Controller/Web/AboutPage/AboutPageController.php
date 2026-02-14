<?php

namespace App\Controller\Web\AboutPage;

use App\Repository\PageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AboutPageController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function aboutPage(PageRepository $pageRepository): Response
    {
        $pageData = $pageRepository->findOneBySlugWithActiveBlocksAndPosts('about');

        $aboutHero = null;
        $aboutMission = null;
        $aboutValues = null;
        $aboutEducation = null;
        $aboutReassurance = null;

        if ($blocks = $pageData?->getBlocks()) {
            foreach ($blocks as $block) {
                if ($block->getSlug() === 'about_hero') $aboutHero = $block;
                if ($block->getSlug() === 'about_mission') $aboutMission = $block;
                if ($block->getSlug() === 'about_values') $aboutValues = $block;
                if ($block->getSlug() === 'about_education') $aboutEducation = $block;
                if ($block->getSlug() === 'about_reassurance') $aboutReassurance = $block;
            }
        }

        return $this->render('web/about_page/index.html.twig', [
            'active_tab' => 'about_page',
            'about_hero' => $aboutHero,
            'about_mission' => $aboutMission,
            'about_values' => $aboutValues,
            'about_education' => $aboutEducation,
            'about_reassurance' => $aboutReassurance,
        ]);
    }
}
