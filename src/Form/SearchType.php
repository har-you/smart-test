<?php


namespace App\Form;


use App\Dto\Search;
use App\Entity\Celebrity;
use App\Entity\City;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class SearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstLastname', TextType::class, ['required' => false, 'label' => 'Nom et/ou Prénom'])
            ->add('nickName', TextType::class, ['required' => false, 'label' => 'Surnom'])
            ->add('city', EntityType::class, [
                'required' => false,
                'label' => 'Ville Sépulture',
                'class' => City::class,
                'choice_label' => function (City $city) {
                return $city->getZipCode().' - '.$city->getLabel();
                },
                'empty_data' => null,
            ])
            ->add('profession', ChoiceType::class, [
                'required' => false,
                'label' => 'Profession',
                'choices' =>  array_combine($options['professions'], $options['professions']),
            ])
            ->add('nationality', ChoiceType::class, [
                'multiple' => true, 'expanded' => false, 'required' => false,
                'label' => 'Nationalité',
                'choices' => array_combine($options['nationalities'], $options['nationalities']),
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Search::class,
                'nationalities' => [],
                'professions' => []
            ]
        );
    }
}