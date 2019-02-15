<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->countrychoices = $options['countrychoices'];
        $this->fileindication = $options['fileindication'];
        $this->requirefile = $options['requirefile'];

        $builder
            ->add('country', ChoiceType::class, [
                'label' => 'pays',
                'choices' => $this->countrychoices
            ])
            ->add('name', null, [
                'label' => "nom de l'étape",
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'arrière-plan',
                'required' => $this->requirefile,
                'help' => $this->fileindication
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
            'countrychoices' => null,
            'fileindication' => null,
            'requirefile' => null,
        ]);
    }
}
