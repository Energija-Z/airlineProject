<?php
namespace App\Form;

use App\Entity\RouteModel;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RouteForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('originAirport', TextType::class, ["label" => "Origin airport: "])
            ->add('destinationAirport', TextType::class, ["label" => "Destination airport: "])
            ->add('airline', TextType::class, ["label" => "Airline: "])
            /*('airportOption', ChoiceType::class, [
                'choices'  => [
                    'Aiport 1' => "Aiport 1",
                    'Aiport 1' => "Aiport 2"
                ],
            ]);*/
            ->add('save', SubmitType::class)
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]/*['data_class' => AirlineModel::class]*/);
    }
}