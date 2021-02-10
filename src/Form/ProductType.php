<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Employee;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Category;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Denumire Produs '])
            ->add('price', NumberType::class, ['label'=>'Pret '])
            ->add('produced_date', DateType::class, ['label'=>'Data la care a fost produs ',
                                                     'years'=>range(2020,2022,1),
                                                     'widget' => 'single_text'])
            ->add('category', EntityType::class, ['class' => Category::class, 'choice_label' =>'name'])
            ->add('quantity', NumberType::class, ['label'=>'Stoc '])
            ->add('measure_unit', ChoiceType::class, ['label'=>'Unitate de masura ',
                'choices'  => [
                'Kilograme' => 'kg',
                'Litru' => 'l',
                'Bucata' => 'b']])
            ->add('Submit', SubmitType::class, ['label'=>'Salveaza produs', 'attr' => ['class' => 'btn btn-success']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
