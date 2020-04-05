<?php


namespace App\Form;



use App\DBAL\EnumChannelType;
use App\Entity\Answer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class AnswerType
 */
class AnswerType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('body', TextareaType::class, ['constraints' => [new NotBlank()]])
           ->add('channel', ChoiceType::class, ['constraints' => new NotBlank(), 'choices' => [EnumChannelType::CHANNEL_FAQ, EnumChannelType::CHANNEL_BOT]])
           ;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Answer::class,
                'csrf_protection' => false,
            ]
        );
    }
}
