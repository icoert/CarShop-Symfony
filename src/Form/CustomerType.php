<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\UserType;
use App\Form\DeliveryAddressType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', UserType::class, ['label'=>'Client', 
                                            'constraints' =>[new NotBlank()]])
            ->add('delivery_address', DeliveryAddressType::class, ["label"=>"Adresa de livrare"])
            ->add('phone', TextType::class, ['label'=>'Telefon ',
                            'required' => true,
                            'constraints' => [new Regex(['pattern' => '/^[0-9]{10}$/',
                                                          'message' => 'Telefon invalid'])]])
            ->add('Submit', SubmitType::class, ['label'=>'Salveaza client', 'attr' => ['class' => 'btn btn-success']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
