<?php

namespace App\Form\Type;

use App\Entity\MutationAccount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * MutationAccountType.
 *
 * @author Matthijs Hasenpfliug <matthijs@connectholland.nl>
 */
class MutationAccountType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('company', TextType::class, [
                'disabled' => true,
            ])
            ->add('category', ChoiceType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'choices' => [
                    'app.bankaccount.category.supermarket' => 'supermarket',
                    'app.bankaccount.category.clothing_store' => 'clothing_store',
                ],
            ])
            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MutationAccount::class,
        ]);
    }
}
