<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Pour la partie contact :
use Doctrine\ORM\EntityManagerInterface; // pour la gestion des entités
use Symfony\Component\HttpFoundation\Request; // pour les requetes HTTP (GET POST ...)
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert; // Pour mettre des contraintes de validation sur nos champs
use App\Entity\Contact;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();

        $form = $this->createFormBuilder($contact)
        ->add('nom', TextType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le nom ne doit pas être vide']),
            ],
        ])
        ->add('prenom', TextType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le prénom ne doit pas être vide']),
            ],
            'label' => 'Prénom',
        ])
        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le mail ne doit pas être vide']),
                new Assert\Email(['message' => 'Le mail doit avoir un format valide']),
            ],
        ])
        ->add('sujet', TextType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le sujet ne doit pas être vide']),
            ],
        ])
        ->add('message', TextareaType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le message ne doit pas être vide']),
            ],
        ])
        ->add('save', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-outline-success w-100',
            ],
            'label' => 'Envoyer',
        ])
        ->getForm();  

        $form->handleRequest($request); // on récupère la requete http
        
        if($form->isSubmitted() && $form->isValid()) { // isValid() vérifie les contraintes que l'on a mis sur les champs
            // dd($contact);
            $contact = $form->getData(); // on récupère l'objet $contact contenant les données du form
            $contact->setDateContact(new \DateTime()); // on force la valeur de la date contact car attendue en BDD mais non présente dans le form

            $em->persist($contact); // pour delete ->remove($contact)
            $em->flush(); // Valide l'opération (insert, update, delete) 

            // on rajoute un message flash
            $this->addFlash('success', 'Nous avons bien reçu votre demande de contact.');

            return $this->redirectToRoute('contact'); // on redirige

        }
        
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/affichage_contact', name: 'admin_affichage_contact')]
    public function affichageContact(EntityManagerInterface $em) : Response
    {
        return $this->render('admin_affichage/index.html.twig', [
            'list' => $em->getRepository(Contact::class)->findAll() 
        ]); 
    }



}
