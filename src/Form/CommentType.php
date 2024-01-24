<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fname')
            ->add('lname')
            ->add('comment')
            ->add('note', IntegerType::class, [
                'label' => 'note sur 5',
                'attr' =>
                [
                'min' => 0, 'max' => 5,
                'placeholder' => 'Votre note'
                ]
                ])
                
            // ->add('active')
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
