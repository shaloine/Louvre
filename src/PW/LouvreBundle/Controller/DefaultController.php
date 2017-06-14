<?php

namespace PW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PWLouvreBundle:Default:index.html.twig');
    }
}
