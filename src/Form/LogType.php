<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Log;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->fileindication = $options['fileindication'];

        $builder
            ->add('title', null, [
                'label' => 'titre'
            ])
            ->add('topic', ChoiceType::class, [
                'label' => 'catégorie',
                'choices' => array_flip(Log::TOPIC['full_name'])
            ])
            ->add('date', null, [
                'label' => 'date'
            ])
            ->add('picture_position', ChoiceType::class, [
                'label' => "positionnement de l'image",
                'choices' => array_flip(Log::POSITION),
                'help' => "Détermine si l'image sera placée avant, après, ou au milieu du contenu."
            ])
            ->add('content', null, [
                'label' => 'contenu'
            ])
            ->add('content2', null, [
                'label' => '(Contenu secondaire)',
                'help' => "Si l'image est placée au milieu du texte, ce champ constituera la seconde partie du contenu."
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'illustration',
                'required' => false,
                'help' => $this->fileindication
            ])
            ->add('alt', TextareaType::class, [
                'required' => false,
                'label' => 'texte alternatif',
                'help' => "/!\ l'attribut \"alt\" des images sert aux mal-voyants et au SEO."
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Log::class,
            'fileindication' => null,
        ]);
    }
}
