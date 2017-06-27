<?php

namespace PW\LouvreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        $nbArray = array();
        for ($i=1; $i <= 50; $i++) { 
            $nbArray[$i] = $i;
        }

        $builder
        ->add('date',      DateType::class, array('widget' => 'single_text', 'html5' => false, 'format' => 'dd/MM/yyyy', 'model_timezone' => 'Europe/Paris'))
        ->add('nombre',     ChoiceType::class, array('choices' =>$nbArray))
        ->add('demi',   ChoiceType::class, array('choices' => array('Journée' => true, 'Demi-journée' =>false), 'expanded' => true))
        ->add('visitors', CollectionType::class, array('entry_type' => VisitorType::class, 'label' => false))
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
