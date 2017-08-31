<?php

namespace BookingApp\Controllers;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormFactory;

class CreateBookingController
{
    public function __construct(FormFactory $formFactory, \Twig_Environment $twigEnv)
    {
        $this->formFactory = $formFactory;
        $this->twigEnv = $twigEnv;
    }

    public function __invoke()
    {
        $form = $this->formFactory->createBuilder(FormType::class)
            ->add('firstName', TextType::class, ['required' => true])
            ->add('lastName', TextType::class, ['required' => true])
            ->add('phone', TextType::class, ['required' => true])
            ->add('email', TextType::class, ['required' => false])
            ->add('birthday', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
            ])
            ->add('startDate', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
            ])
            ->add('endDate', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
            ])
            ->add('arrivalTime', TimeType::class, ['required' => true])
            ->add('nrOfPeople', IntegerType::class, ['required' => true])
            ->add('payingMethod', ChoiceType::class, [
                'choices' => [
                    'cash' => 'cash',
                    'transfer' => 'transfer',
                ],
                'required' => true,
            ])
            ->add('additionalInformation', TextareaType::class, [
                'required' => false
            ])
            ->add('submit', SubmitType::class, ['label' => 'Send booking'])
            ->getForm()
        ;

        return $this->twigEnv->render('form.html.twig', ['form' => $form->createView()]);
    }
}
