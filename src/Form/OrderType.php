<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\OrderDetailsType;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created_date', DateType::class, ['label'=>'Data plasare comanda ',
                                                    'years'=>range(2020,2022,1),
                                                    'widget' => 'single_text'])
            ->add('status', ChoiceType::class, ['choices'  => [
                'Plasata' => 'Comanda plasata',
                'Confirmata' => 'Comanda in curs de livrare',
                'Livrata' => 'Comanda a fost livrata']])
            ->add('delivery_date', DateType::class, ['label'=>'Data estimata livrare ',
                                                     'years'=>range(2020,2022,1),
                                                     'widget' => 'single_text'])
            ->add('details', CollectionType::class, [
                'entry_type' => OrderDetailsType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false])
            ->add('Submit', SubmitType::class, ['label'=>'Salveaza comanda', 'attr' => ['class' => 'btn btn-success']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
