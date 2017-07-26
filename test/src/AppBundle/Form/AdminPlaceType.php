<?php
declare(strict_types=1);

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


use AppBundle\Form\DataTransformer\HasImageTransformer;

class AdminPlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new HasImageTransformer();

        $builder
            ->add('name', TextType::class)
            ->add('imageFile')
            // removing this file "magically" make the validator to works
            ->addModelTransformer($transformer)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\Place',
            ]
        );
    }
}

