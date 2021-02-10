<?php

namespace App\Form;

use App\Entity\DeliveryAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\NotBlank;

class DeliveryAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', TextType::class, ['label'=>'Localitate ',
                                            'constraints' =>[new NotBlank()]])
            ->add('street', TextType::class, ['label'=>'Strada ',
                                              'constraints' =>[new NotBlank()]])
            ->add('number', TextType::class, ['label'=>'Nr. ',
                                              'constraints' =>[new NotBlank()]])
            ->add('otherDetails', TextType::class, ['label'=>'Alte detalii ']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DeliveryAddress::class,
        ]);
    }
}
