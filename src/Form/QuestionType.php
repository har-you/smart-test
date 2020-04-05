<?php

namespace App\Form;

use App\DBAL\EnumStatusType;
use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Valid;

/**
 * Class QuestionType
 */
class QuestionType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['constraints' => [new NotBlank()]])
            ->add('promoted', ChoiceType::class, ['choices' => [true, false], 'constraints' => [new NotNull()]])
            ->add('status', ChoiceType::class, ['constraints' => [new NotBlank()], 'choices' => [EnumStatusType::STATUS_DRAFT, EnumStatusType::STATUS_PUBLISHED]])
            ->add('answers', CollectionType::class, ['constraints' => [new Valid()], 'entry_type' => AnswerType::class, 'allow_add' => true, 'by_reference' => false])
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'data_class' => Question::class,
                    'csrf_protection' => false,
                ]
            );
    }
}