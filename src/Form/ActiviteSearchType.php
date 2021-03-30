<?php

namespace App\Form;

use App\Entity\ActiviteSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice' , IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' =>'budget max'
                ]
            ])
            ->add('minDuration' , IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' =>'duree minimale'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActiviteSearch::class,
            'method' => 'get' ,
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
