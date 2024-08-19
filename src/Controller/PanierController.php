<?php 
namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PanierController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/panier', name: 'panier')]
    public function afficherPanier(SessionInterface $session): Response
    {
        $panier = $session->get('panier', []);

        // Récupérer les produits complets depuis la base de données
        $produits = $this->entityManager
            ->getRepository(Produit::class)
            ->findBy(['id' => array_keys($panier)]);

        // Calculer le total du panier
        $total = array_reduce($produits, function ($carry, $produit) use ($panier) {
            return $carry + ($produit->getPrixProd() * $panier[$produit->getId()]);
        }, 0);

        return $this->render('panier.html.twig', [
            'produits' => $produits,
            'panier' => $panier,
            'total' => $total,
        ]);
    }

    #[Route('/panier/retirer/{id}', name: 'panier_retirer')]
    public function retirerDuPanier(int $id, SessionInterface $session): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $panier = $session->get('panier', []);

        if (isset($panier[$id])) {
            unset($panier[$id]);
            $session->set('panier', $panier);
        }

        return $this->redirectToRoute('panier');
    }

    // #[Route('/panier/modifier/{id}', name: 'panier_modifier')]
    // public function modifierQuantite(int $id, Request $request, SessionInterface $session): Response
    // {
    //     $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    //     $quantite = $request->query->getInt('quantite', 1);

    //     if ($quantite < 1) {
    //         $this->addFlash('error', 'La quantité doit être au moins 1.');
    //         return $this->redirectToRoute('panier');
    //     }

    //     $panier = $session->get('panier', []);

    //     if (isset($panier[$id])) {
    //         $panier[$id] = $quantite;
    //         $session->set('panier', $panier);
    //     } else {
    //         $this->addFlash('error', 'Le produit n\'est pas dans le panier.');
    //     }

    //     return $this->redirectToRoute('panier');
    // }
}
