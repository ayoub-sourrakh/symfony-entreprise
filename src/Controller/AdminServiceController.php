<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Service;
use App\Form\ServiceType;

class AdminServiceController extends AbstractController
{
    #[Route('/admin/service', name: 'admin_service')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $service = new Service();

        $form = $this->createForm(ServiceType::class, $service);

        $form->handleRequest($request); 
        // 1. vérification de la methode (on vérifie si le form à été validé)
        // 2. remplit l'objet form avec les données

        if($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();

            $nomService = $service->getNomService(); // on récupère le nom saisi

            $checkService = $em->getRepository(Service::class)->findOneBy(['nomService' => $nomService]);

            if ($checkService) {
                $this->addFlash('error', 'Le nom de service existe déjà.');
            } else {
                $em->persist($service);
                $em->flush();
    
                $this->addFlash('success', 'Le service a bien été enregistré.');
            }

            return $this->redirectToRoute('admin_service'); // on redirige
        }

        return $this->render('admin_service/index.html.twig', [
            'form' => $form->createView(),
            'list' => $em->getRepository(Service::class)->findAll() 
        ]);
    }
}
