<?php 
namespace App\Controller;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;
// use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PanierController extends AbstractController
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    #[Route('/panier', name: 'panier_afficher')]
    public function afficherPanier(SessionInterface $session): Response
    {
        // Récupérer les IDs des produits depuis la session
        $panier = $session->get('panier', []);

        if (empty($panier)) {
            $produits = [];
            $total = 0;
        } else {
            // Rechercher les produits dans la base de données en utilisant une requête SQL
            $ids = implode(',', array_keys($panier));
            $sql = "SELECT p.id, p.nom_prod, p.prix_prod, i.nom_image
                    FROM produit p
                    JOIN images_produit ip ON p.id = ip.produit_id
                    JOIN images i ON ip.image_id = i.id
                    WHERE p.id IN ($ids)";
            $produitsData = $this->connection->fetchAllAssociative($sql);

            $produits = [];
            foreach ($produitsData as $data) {
                $id = $data['id'];
                $produits[$id] = [
                    'id' => $id,  // Assurez-vous d'inclure l'ID ici
                    'nomProd' => $data['nom_prod'],
                    'prixProd' => $data['prix_prod'],
                    'nomImage' => $data['nom_image'],
                    'quantite' => $panier[$id]
                ];
            }

            // Calculer le total
            $total = array_sum(array_map(function ($produit) {
                return $produit['prixProd'] * $produit['quantite'];
            }, $produits));

        }

        return $this->render('panier.html.twig', [
            'produits' => $produits,
            'total' => $total,
        ]);
    }


    #[Route('/ajouter-au-panier/{id}', name: 'panier_ajouter')]
    public function ajouterProduitAuPanier(int $id, SessionInterface $session): Response
    {
        // Récupérer le panier de la session
        $panier = $session->get('panier', []);

        // Ajouter ou mettre à jour la quantité du produit dans le panier
        if (isset($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        // Mettre à jour la session avec le panier modifié
        $session->set('panier', $panier);

        // Rediriger vers l'affichage du panier
        return $this->redirectToRoute('panier_afficher');
    }

    #[Route('/panier/retirer/{id}', name: 'panier_retirer')]
    public function retirerProduitDuPanier(int $id, SessionInterface $session): Response
    {
        // Récupérer le panier actuel depuis la session
        $panier = $session->get('panier', []);
    
        // Vérifier si le produit est dans le panier
        if (isset($panier[$id])) {
            // Réduire la quantité du produit de 1
            $panier[$id]--;
    
            // Si la quantité atteint 0, retirer le produit du panier
            if ($panier[$id] <= 0) {
                unset($panier[$id]);
            } else {
                // Sinon, mettre à jour la quantité dans le panier
                $panier[$id] = max($panier[$id], 1); // Assure que la quantité ne soit pas inférieure à 1
            }
        }
    
        // Enregistrer le panier mis à jour dans la session
        $session->set('panier', $panier);
    
        // Rediriger vers la page du panier
        return $this->redirectToRoute('panier_afficher');
    }

}
