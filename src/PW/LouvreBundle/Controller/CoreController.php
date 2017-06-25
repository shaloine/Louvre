<?php

namespace PW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PW\LouvreBundle\Form\ReservationType;
use PW\LouvreBundle\Entity\Reservation;
use PW\LouvreBundle\Entity\Visitor;
use Symfony\Component\HttpFoundation\Session;
use \DateTime;

class CoreController extends Controller
{
  public function indexAction(Request $request)
  {

    $reservation = new Reservation();

    $form   = $this->createForm(ReservationType::class, $reservation);

    if ($request->isMethod('POST')) {

      $form->handleRequest($request);

      if ($form->isValid()) {

        //acces service controle de date 
        $dateControl = $this->container->get('pw_louvre.dateControl');

        //si la date n'est pas bonne retour sur la page d'accueil + message en fonction du cas
        if($dateControl->isDateCorrect($request, $reservation)){

          return $this->render('PWLouvreBundle:Core:index.html.twig', array(
            'form' => $form->createView(),
            ));

        }
        
        //Si la date est bonne on verifie si le nombre de réservation maximum pour ce jour est atteint
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('PWLouvreBundle:Reservation')
        ;

        $year  = $reservation->getdate()->format('Y');
        $month = $reservation->getdate()->format('m');
        $day = $reservation->getdate()->format('d');

        $date = new DateTime( $year .'-' . $month . '-' . $day);

        $listVisitor = $repository->findBy(
          array('date' => $date)
          );

        $totalvisite = 0;

        foreach ($listVisitor as $visitor) {

          $totalvisite +=  $visitor->getNombre();
        }

        if (($totalvisite + $reservation->getNombre()) > 1000){

          $request->getSession()->getFlashBag()->add('notice', 'Plus de places disponible pour cette date');

          return $this->render('PWLouvreBundle:Core:index.html.twig', array(
            'form' => $form->createView(),
            ));
        }
        

        $this->get('session')->set('ObjReservation', serialize($reservation));

        return $this->redirectToRoute('pw_louvre_reservation');
      }
    }


    return $this->render('PWLouvreBundle:Core:index.html.twig', array(
      'form' => $form->createView(),
      ));
  }

  public function reservationAction(Request $request)
  {

    $reservation = unserialize($this->get('session')->get('ObjReservation'));
    $nbTickets = $reservation->getNombre();

    if ( count($reservation->getVisitors()) == 0 ){
      for ($i = 0; $i < $nbTickets; $i++){
        $visitor = new visitor();
        $reservation->addVisitor($visitor);
      }
    }

    
    $form   = $this->createForm(ReservationType::class, $reservation);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

      $prix = $this->container->get('pw_louvre.priceCalculation');

      $prix->setPrice($reservation);

      $this->get('session')->set('ObjReservation', serialize($reservation));

      return $this->redirectToRoute('pw_louvre_confirmation');

    }

    return $this->render('PWLouvreBundle:Core:reservation.html.twig', array(
      'form' => $form->createView(),
      'reservation' => $reservation
      ));
  }

  public function confirmationAction(Request $request)
  {
    $reservation = unserialize($this->get('session')->get('ObjReservation'));

    return $this->render('PWLouvreBundle:Core:confirmation.html.twig', array(
      'reservation' => $reservation
      ));
    
  }

  public function validationAction(Request $request)
  {


  }

}
