<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', UserType::class, ['label'=>'Angajat',
                                            'constraints' =>[new NotBlank()]])
            ->add('started_date', DateType::class, ['label'=>'Angajat din anul',
                                                    'years'=>range(1900,2021,1),
                                                    'widget' => 'single_text'])
            ->add('description', TextType::class, ['label'=>'Scurta descriere'])
            ->add('rate', IntegerType::class, ['label'=>'Nota angajat', 'attr' => array('min' => 1, 'max' => 10)])
            ->add('Submit', SubmitType::class, ['label'=>'Salveaza angajat', 'attr' => ['class' => 'btn btn-success']]);
    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
