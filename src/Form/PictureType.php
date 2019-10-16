<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options )
    {

        $this->countrychoices = $options['countrychoices'];
        $this->tagchoices = $options['tagchoices'];
        $this->fileindication = $options['fileindication'];
        $this->requirefile = $options['requirefile'];

        $builder
            ->add('title', null, [
                'label' => 'titre'
            ])
            ->add('country', ChoiceType::class, [
                'label' => 'pays',
                'choices' => $this->countrychoices
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'commentaire',
                'required' => false
            ])
            ->add('tag', ChoiceType::class, [
                'label' => 'tags',
                'multiple' => true,
                'expanded' => true,
                'choices' => $this->tagchoices
            ])
            ->add('date', null, [
                'label' => 'date',
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'photo',
                'required' => $this->requirefile,
                'help' => $this->fileindication
            ])
            ->add('alt', TextareaType::class, [
                'required' => true,
                'label' => 'texte alternatif',
                'help' => "/!\ l'attribut \"alt\" des images sert aux mal-voyants et au SEO."
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
            'countrychoices' => null,
            'tagchoices' => null,
            'fileindication' => null,
            'requirefile' => null,
        ]);
    }
}
