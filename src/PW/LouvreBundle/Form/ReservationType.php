<?php

namespace PW\LouvreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use PW\LouvreBundle\Form\VisitorType;
class ReservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('date',      DateType::class, array('label' => 'Date de la réservation', 'widget' => 'single_text', 'html5' => false, 'attr' => ['class' => 'js-datepicker'], 'format' => 'dd/MM/yyyy', 'model_timezone' => 'Europe/Paris'))
        ->add('nombre',     NumberType::class, array('label' => 'Nombre de visiteur'))
        ->add('demi',   ChoiceType::class, array('label' => 'Durée de la visite', 'choices' => array('Journée' => true, 'Demi-journée' =>false), 'expanded' => true))
        ->add('mail',   EmailType::class, array('label' => 'Veuillez saisir votre adresse mail'))
        ->add('visitors', CollectionType::class, array('entry_type' => VisitorType::class, 'attr' => ['class' => 'test']))
        ->add('save',      SubmitType::class, array('label' => 'Réserver'))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PW\LouvreBundle\Entity\Reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pw_louvrebundle_reservation';
    }


}
