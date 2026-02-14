<?php

namespace App\Controller\Web\PricingPage;

use App\Repository\PageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PricingPageController extends AbstractController
{
    #[Route('/pricing', name: 'app_pricing')]
    public function pricingPage(PageRepository $pageRepository): Response
    {
        $pageData = $pageRepository->findOneBySlugWithActiveBlocksAndPosts('pricing');

        $pricingHero = null;
        $pricingRates = null;
        $pricingRules = null;
        $pricingCta = null;

        if ($blocks = $pageData?->getBlocks()) {
            foreach ($blocks as $block) {
                if ($block->getSlug() === 'pricing_hero') $pricingHero = $block;
                if ($block->getSlug() === 'pricing_rates') $pricingRates = $block;
                if ($block->getSlug() === 'pricing_rules') $pricingRules = $block;
                if ($block->getSlug() === 'pricing_cta') $pricingCta = $block;
            }
        }

        return $this->render('web/pricing_page/index.html.twig', [
            'active_tab' => 'pricing_page',
            'pricing_hero' => $pricingHero,
            'pricing_rates' => $pricingRates,
            'pricing_rules' => $pricingRules,
            'pricing_cta' => $pricingCta,
        ]);
    }
}
