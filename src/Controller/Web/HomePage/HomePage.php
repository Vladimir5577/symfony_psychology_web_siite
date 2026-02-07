<?php

namespace App\Controller\Web\HomePage;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomePage extends AbstractController
{
    #[Route('/', name: 'app_web')]
    public function homePage(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findBy(
            ['isActive' => true],
            ['createdAt' => 'DESC']
        );

        return $this->render('web/home_page/index.html.twig', [
            'controller_name' => 'WebController',
            'products' => $products,
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
