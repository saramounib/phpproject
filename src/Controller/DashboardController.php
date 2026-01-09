<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use App\Repository\PanierRepository;
use App\Repository\ClientRepository; // <-- ajouter le repository client
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        ProduitRepository $produitRepository,
        CategorieRepository $categorieRepository,
        PanierRepository $panierRepository,
        ClientRepository $clientRepository // <-- injecter le repository client
    ): Response {
        return $this->render('dashboard/index.html.twig', [
            'nbProduits' => $produitRepository->count([]),
            'nbCategories' => $categorieRepository->count([]),
            'nbPaniers' => $panierRepository->count([]),
            'nbClients' => $clientRepository->count([]), // <-- ajouter le nombre de clients
        ]);
    }
}
