<?php

/*
 * This file is part of the JMT catalog package.
 *
 * (c) Connect Holland.
 */

namespace App\Form\Type;

use App\Entity\Bankaccount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * CustomEventInformationType.
 *
 * @author Reyo Stallenberg <reyo@connectholland.nl>
 */
class BankaccountType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('company', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('accountNumber', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('category', ChoiceType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'choices' => [
                    'supermarket',
                    'clothing_store',
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
            'data_class' => Bankaccount::class,
        ]);
    }
}
