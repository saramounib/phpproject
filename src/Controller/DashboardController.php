<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        // Bloquer tout accès si l'utilisateur n'est pas connecté
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('dashboard/index.html.twig', [
            'nbProduits' => 10,
            'nbCategories' => 5,
            'nbPaniers' => 3,
            'nbClients' => 7,
        ]);
    }
}
