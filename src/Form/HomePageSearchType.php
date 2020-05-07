<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomePageSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pick_up_location', ChoiceType::class, [
                'mapped' => false,
                'expanded' => false,
                'multiple' => false,
                'choices' => [
                    'Select' => '',
                    'Airport Of Mauritius' => '1',
                ],
                'attr' => [
                    'class' => 'custom-select',
                ],
                'label' => 'PICK-UP LOCATION:',
            ])
            ->add('pick_up_date', TextType::class, [
                'label' => 'PICK-UP DATE:',
                'attr' => [
                    'placeholder' => 'Pick Up Date',
                ],
            ])
            ->add('return_date', TextType::class, [
                'label' => 'RETURN DATE:',
                'attr' => [
                    'placeholder' => 'Return Date',
                ],
            ])
            ->add('car_type', ChoiceType::class, [
                'mapped' => false,
                'expanded' => false,
                'multiple' => false,
                'choices' => [
                    'Select' => '',
                    'Aston Martin' => '1',
                    'BMW' => '2',
                    'Lamborghini' => '3',
                    'Jeep' => '4',
                ],
                'attr' => [
                    'class' => 'custom-select',
                ],
                'label' => 'CHOOSE CAR TYPE:',
            ])
            ->add('book_now', SubmitType::class, [
                'label' => 'BOOK NOW',
                'attr' => [
                    'class' => 'book-now-btn',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
