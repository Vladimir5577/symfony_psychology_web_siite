<?php

namespace App\Controller\Web\ContactPage;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ContactPageControler extends AbstractController
{
    #[Route('/contacts', name: 'app_contacts')]
    public function homePage(): Response
    {

        return $this->render('web/contacts_page/index.html.twig', [
            'active_tab' => 'contacts_page',
        ]);
    }
}
