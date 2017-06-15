<?php

namespace PW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

use PW\LouvreBundle\Entity\Reservation;

class CoreController extends Controller
{
  public function indexAction(Request $request)
  {


     $reservation = new Reservation();

    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $reservation);

    $formBuilder
      ->add('date',      DateType::class, array('label' => 'Date de la réservation'))
      ->add('nombre',     NumberType::class, array('label' => 'Nombre de visiteur'))
      ->add('demi',   CheckboxType::class, array('label' => 'Demi-journée', 'required' => false))
      ->add('mail',   EmailType::class, array('label' => 'Veuillez saisir votre adresse mail'))
      ->add('save',      SubmitType::class, array('label' => 'Réserver'))
    ;

    $form = $formBuilder->getForm();

    return $this->render('PWLouvreBundle:Core:index.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function reservationAction()
  {
    return $this->render('PWLouvreBundle:Core:reservation.html.twig');
  }
}
