<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Employe;
use App\Form\EmployeType;

class AdminEmployeController extends AbstractController
{
    #[Route('/admin/employe', name: 'admin_employe')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $employe = new Employe();

        $form = $this->createForm(EmployeType::class, $employe);

        $form->handleRequest($request); 
        // 1. vérification de la methode (on vérifie si le form à été validé)
        // 2. remplit l'objet form avec les données

        if($form->isSubmitted() && $form->isValid()) {
            $employe = $form->getData();

            $em->persist($employe);
            $em->flush();

            $this->addFlash('success', 'L\'employé a bien été enregistré.');

            return $this->redirectToRoute('admin_employe');
        }

        return $this->render('admin_employe/index.html.twig', [
            'form' => $form->createView(),
            'list' => $em->getRepository(Employe::class)->findAll() 
        ]);
    }
}
