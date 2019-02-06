<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\PictureSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->countrychoices = $options['countrychoices'];
        $this->tagchoices = $options['tagchoices'];

        $builder
            ->add('country', ChoiceType::class, [
                'required' => false,
                'label' => 'pays',
                'placeholder' => '-- Tous --',
                'choices' => $this->countrychoices
            ])
            ->add('tags', ChoiceType::class, [
                'required' => false,
                'label' => 'tags',
                'multiple' => true,
                'expanded' => true,
                'choices' => $this->tagchoices
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PictureSearch::class,
            'method' => 'get',
            'csrf_protection' => false,
            'countrychoices' => null,
            'tagchoices' => null,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
