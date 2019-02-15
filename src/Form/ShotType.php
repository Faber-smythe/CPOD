<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Shot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->countrychoices = $options['countrychoices'];
        $this->stagechoices = $options['stagechoices'];
        $this->fileindication = $options['fileindication'];
        $this->requirefile = $options['requirefile'];

        $builder
            ->add('country', ChoiceType::class, [
                'label' => 'pays',
                'choices' => $this->countrychoices
            ])
            ->add('stage', ChoiceType::class, [
                'label' => 'étape',
                'choices' => $this->stagechoices
            ])
            ->add('title', null, [
                'label' => 'titre'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'description'
            ])
            ->add('orientation', ChoiceType::class, [
                'label' => 'orientation',
                'choices' => (Shot::ORIENTATION)
            ])
            ->add('position', ChoiceType::class, [
                'label' => 'position',
                'choices' => (Shot::POSITION)
            ])
            ->add('layout', ChoiceType::class, [
                'label' => 'intitulé',
                'choices' => (Shot::LAYOUT)
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'photo',
                'required' => $this->requirefile,
                'help' => $this->fileindication
            ])
            ->add('alt', TextareaType::class, [
                'label' => 'texte alternatif',
                'help' => "/!\ l'attribut \"alt\" des images sert aux mal-voyants et au SEO."
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shot::class,
            'countrychoices' => null,
            'stagechoices' => null,
            'fileindication' => null,
            'requirefile' => null,
        ]);
    }
}
