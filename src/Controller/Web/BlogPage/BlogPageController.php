<?php

namespace App\Controller\Web\BlogPage;

use App\Repository\PageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class BlogPageController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function blogPage(PageRepository $pageRepository): Response
    {
        $pageData = $pageRepository->findOneBySlugWithActiveBlocksAndPosts('blog');

        $blogHero = null;
        $blogIntro = null;
        $blogPosts = null;

        if ($blocks = $pageData?->getBlocks()) {
            foreach ($blocks as $block) {
                if ($block->getSlug() === 'blog_hero') $blogHero = $block;
                if ($block->getSlug() === 'blog_intro') $blogIntro = $block;
                if ($block->getSlug() === 'blog_posts') $blogPosts = $block;
            }
        }

        return $this->render('web/blog_page/index.html.twig', [
            'active_tab' => 'blog_page',
            'blog_hero' => $blogHero,
            'blog_intro' => $blogIntro,
            'blog_posts' => $blogPosts,
        ]);
    }
}
