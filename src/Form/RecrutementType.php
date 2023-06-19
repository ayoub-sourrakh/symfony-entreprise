<?php

namespace App\Form;

use App\Entity\Recrutement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type; 
use Symfony\Component\Validator\Constraints as Assert; 


class RecrutementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', Type\TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le nom ne doit pas être vide']),
                ],
            ])
            ->add('prenom', Type\TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le prénom ne doit pas être vide']),
                ],
                'label' => 'Prénom',
            ])
            ->add('poste', Type\ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select',
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le poste ne doit pas être vide']),
                ],
                'choices' => [
                    'Ingénieur' => 'ingenieur',
                    'Commercial' => 'commercial',
                    'Informatique' => 'informatique',
                    'Développeur' => 'developpeur',
                    'Designer' => 'designer',
                ],
            ])
            ->add('cv', Type\FileType::class, [
                'constraints' => [
                    new Assert\File([                  
                        'maxSize'   => '2M', // taille maximale acceptée             
                        'mimeTypes' => ['application/pdf'], // type
                        'mimeTypesMessage' => 'Le cv est obligatoire est doit être de type pdf',
                ]),

                ],
            ])
            ->add('message', Type\TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le message ne doit pas être vide']),
                ],
            ])
            // ->add('dateRecrutement')
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
            'data_class' => Recrutement::class,
        ]);
    }
}
