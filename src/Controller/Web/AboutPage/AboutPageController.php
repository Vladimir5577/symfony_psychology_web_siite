<?php

namespace App\Controller\Web\AboutPage;

use App\Repository\PageRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AboutPageController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function homePage(PageRepository $pageRepository): Response
    {
        return $this->render('web/about_page/index.html.twig', [
            'active_tab' => 'about_page',
        ]);
    }
}
