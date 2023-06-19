<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Recrutement;
use App\Form\RecrutementType;


class RecrutementController extends AbstractController
{
    #[Route('/recrutement', name: 'recrutement')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $recrutement = new Recrutement();

        $form = $this->createForm(RecrutementType::class, $recrutement);

        $form->handleRequest($request); 
        // 1. vérification de la methode (on vérifie si le form à été validé)
        // 2. remplit l'objet form avec les données

        if($form->isSubmitted() && $form->isValid()) {
            $recrutement = $form->getData();
            $cv = $form->get('cv')->getData();
            if($cv) {
                $fileCv = uniqid() . '.' . $cv->guessExtension(); // le nom du fichier pour la bdd

                // on copie le fichier vers un dossier de notre application
                $cv->move(
                    $this->getParameter('cv_directory'), // config/service.yaml : parameters: cv_directory: 'cv'
                    $fileCv
                );

                $recrutement->setCv($fileCv);
            }

            $recrutement->setDateRecrutement(new \DateTime());

            $em->persist($recrutement);
            $em->flush();

            $this->addFlash('success', 'Nous avons bien reçu votre demande de recrutement.');

            return $this->redirectToRoute('recrutement'); // on redirige
        }


        return $this->render('recrutement/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/admin/affichage_recrutement', name: 'admin_affichage_recrutement')]
    public function affichageRecrutement(EntityManagerInterface $em) : Response
    {
        return $this->render('admin_affichage/recrutement.html.twig', [
            'list' => $em->getRepository(Recrutement::class)->findAll() 
        ]); 
    }
}
