<?php

namespace App\Form;

use App\Entity\OrderDetails;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Positive;
use App\Entity\Product;

class OrderDetailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, ['class' => Product::class, 'choice_label' =>'name',
                                                 'required' => true])
            ->add('quantity', IntegerType::class, ['label'=>'Cantitate ', 
                                                   'constraints' => [new Positive(['message' => 'Alege cantitatea'])]]);    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OrderDetails::class,
        ]);
    }
}
