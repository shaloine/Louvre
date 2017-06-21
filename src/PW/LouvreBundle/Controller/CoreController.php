<?php

namespace PW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PW\LouvreBundle\Form\ReservationType;
use PW\LouvreBundle\Entity\Reservation;
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
        
        $request->getSession()->getFlashBag()->add('notice', 'c bon');

        return $this->render('PWLouvreBundle:Core:index.html.twig', array(
          'form' => $form->createView(),
        ));
      }
    }


    return $this->render('PWLouvreBundle:Core:index.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function reservationAction($id)
  {
    return $this->render('PWLouvreBundle:Core:reservation.html.twig', array(
      'id' => $id
    ));
  }
}
