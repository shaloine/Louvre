<?php

namespace PW\LouvreBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PW\LouvreBundle\Entity\Reservation;
use PW\LouvreBundle\Entity\Visitor;
use \DateTime;


class PWPriceCalculationTest extends WebTestCase
{

    public function testOneAdult()
    {
    	$reservation = new Reservation();
    	$reservation->setDemi(1);

    	$visitor1 = new Visitor();
    	$visitor1->setDateNaissance(new \DateTime('1985/01/01'));
    	$visitor1->setReduit(1);

    	$reservation->addVisitor($visitor1);
    	

    	//chargement du service
        $kernel = static::createKernel();
 		$kernel->boot();
 		$container = $kernel->getContainer();
 		$PriceCalculation = $container->get('pw_louvre.priceCalculation');


 		$PriceCalculation->setPrice($reservation);

 		$resultat = $reservation->getPrixTotal();

 		$this->assertEquals(10, $resultat);
    }

    public function testsetPrice2()
    {
        $reservation = new Reservation();
        $reservation->setDemi(1);

        $visitor1 = new Visitor();
        $visitor1->setDateNaissance(new \DateTime('1985/01/01'));
        $visitor1->setReduit(1);

        $reservation->addVisitor($visitor1);
        

        //chargement du service
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();
        $PriceCalculation = $container->get('pw_louvre.priceCalculation');


        $PriceCalculation->setPrice($reservation);

        $resultat = $reservation->getPrixTotal();

        $this->assertEquals(10, $resultat);
    }
}
