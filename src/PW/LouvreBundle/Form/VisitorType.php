<?php

namespace PW\LouvreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class VisitorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom',    TextType::class)
        ->add('prenom',    TextType::class)
        ->add('pays',    CountryType::class, array('preferred_choices' => array('FR')))
        ->add('dateNaissance',      BirthdayType::class, array('format' => 'dd/MM/yyyy', 'label' => 'Date de naissance', 'widget' => 'single_text', 'html5' => false,'model_timezone' => 'Europe/Paris', 'attr' => ['class' => 'js-datepicker']))
        ->add('reduit',    CheckboxType::class, array('label' => 'Tarif réduit', 'required' => false));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PW\LouvreBundle\Entity\Visitor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pw_louvrebundle_visitor';
    }


}
