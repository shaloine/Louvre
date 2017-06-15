<?php

namespace PW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('PWLouvreBundle:Core:index.html.twig');
    }

    public function reservationAction()
    {
        return $this->render('PWLouvreBundle:Core:reservation.html.twig');
    }
}
