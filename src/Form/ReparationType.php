<?php

namespace App\Form;

use App\Entity\Reparation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ReparationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_reparation', TextType::class, ['attr'=> ['class' => 'form-control'], 'label_attr' => ['class' => 'form_label mt-4']])
            ->add('description', TextareaType::class, ['attr'=> ['class' => 'form-control'], 'label_attr' => ['class' => 'form_label mt-4']])
            ->add('date_depot', DateType::class, ['attr'=> ['class' => 'form-control'], 'label_attr' => ['class' => 'form_label mt-4']])
            ->add('envoyer', SubmitType::class, ['attr'=> ['class' => 'btn btn-primary'], 'row_attr' => ['class' => 'text-center mt-4']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reparation::class,
        ]);
    }
}
