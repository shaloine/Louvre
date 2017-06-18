<?php

namespace PW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PW\LouvreBundle\Form\ReservationType;

use PW\LouvreBundle\Entity\Reservation;

class CoreController extends Controller
{
  public function indexAction(Request $request)
  {


     $reservation = new Reservation();

     $form   = $this->createForm(ReservationType::class, $reservation);

      if ($request->isMethod('POST')) {

      $form->handleRequest($request);

      if ($form->isValid()) {

        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        return $this->redirectToRoute('pw_louvre_reservation', array('id' => $reservation->getId()));
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
