<?php

namespace App\Form;

use App\Entity\PublicationForum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PublicationForumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
       
            ->add('user')
            ->add('user',EntityType::class,[
                "class"=>User::class,
                "choice_label"=>"id"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PublicationForum::class,
        ]);
    }
}
