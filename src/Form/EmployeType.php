<?php

namespace App\Form;

use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints as Assert; 
use Symfony\Component\Form\Extension\Core\Type;


class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', Type\TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le nom ne doit pas être vide']), // appelé lors du isValid()
                ],
            ])
            ->add('prenom', Type\TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le prénom ne doit pas être vide']), // appelé lors du isValid()
                ],
            ])
            ->add('sexe', Type\ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le sexe ne doit pas être vide']), // appelé lors du isValid()
                ],
                'choices' => [
                    'Homme' => 'm',
                    'Femme' => 'f',
                ],
            ])
            ->add('dateEmbauche', Type\DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date embauche ne doit pas être vide']), // appelé lors du isValid()
                ],
            ])
            ->add('salaire', Type\NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le salaire ne doit pas être vide']), // appelé lors du isValid()
                    new Assert\Type([
                        'type' => 'numeric',
                        'message' => 'Le salaire doit être numérique.',
                    ]),
                ],
            ])
            ->add('service', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'nomService',
                'attr' => [
                    'class' => 'form-select'
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le service ne doit pas être vide']), 
                ],
            ])
            ->add('save', Type\SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-outline-success w-100',
                ],
                'label' => 'Envoyer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
