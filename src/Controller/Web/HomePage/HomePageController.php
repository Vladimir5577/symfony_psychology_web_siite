<?php

namespace App\Controller\Web\HomePage;

use App\Repository\PageRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_web')]
    public function homePage(PageRepository $pageRepository): Response
    {
        $pageData = $pageRepository->findOneBySlugWithActiveBlocksAndPosts('home');

        $heroBlock = null;
        $marketingBlockRow = null;
        $marketingBlockFeaturette = null;

        if ($blocks = $pageData?->getBlocks()) {
            foreach ($blocks as $block) {
                if ($block->getSlug() == 'hero') $heroBlock = $block;
                if ($block->getSlug() == 'marketing_block_row') $marketingBlockRow = $block;
                if ($block->getSlug() == 'marketing_block_featurette') $marketingBlockFeaturette = $block;
            }
        }

        return $this->render('web/home_page/index.html.twig', [
            'active_tab' => 'home_page',
            'hero_block' => $heroBlock,
            'marketing_block_row' => $marketingBlockRow,
            'marketing_block_featurette' => $marketingBlockFeaturette,
        ]);
    }

    #[Route('/product_details', name: 'app_web_product_details')]
    public function productDetails(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findBy(
            ['isActive' => true],
            ['createdAt' => 'DESC']
        );

        return $this->render('web/index.html.twig', [
            'controller_name' => 'WebController',
            'products' => $products,
        ]);
    }
}
