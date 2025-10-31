<?php
namespace App\Form;

use App\Entity\AirportModel;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AirportForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ["label" => "Name: "])
            ->add('code', TextType::class, ["label" => "Code: "])
            ->add('country', TextType::class, ["label" => "Country: "])
            ->add('location', TextType::class, ["label" => "Location: "])
            ->add('checkbox', CheckboxType::class)
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]/*['data_class' => AirportModel::class]*/);
    }
}