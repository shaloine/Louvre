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
        //reservation journée entière 1 adulte
    	$reservation = new Reservation();
    	$reservation->setDemi(1);

    	$visitor1 = new Visitor();
    	$visitor1->setDateNaissance(new \DateTime('1985/01/01'));
    	$visitor1->setReduit(0);

    	$reservation->addVisitor($visitor1);
    	

    	//chargement du service
        $kernel = static::createKernel();
 		$kernel->boot();
 		$container = $kernel->getContainer();
 		$PriceCalculation = $container->get('pw_louvre.priceCalculation');


 		$PriceCalculation->setPrice($reservation);

 		$resultat = $reservation->getPrixTotal();

 		$this->assertEquals(16, $resultat);
    }

    public function testFamily()
    {

        //reservation 2 adultes 1 enfant 1 moins de 4ans journée entière
        $reservation = new Reservation();
        $reservation->setDemi(1);

        $visitor1 = new Visitor();
        $visitor1->setDateNaissance(new \DateTime('1985/01/01'));
        $visitor1->setReduit(0);
        $visitor2 = new Visitor();
        $visitor2->setDateNaissance(new \DateTime('1986/07/12'));
        $visitor2->setReduit(0);
        $visitor3 = new Visitor();
        $visitor3->setDateNaissance(new \DateTime('2009/11/19'));
        $visitor3->setReduit(0);
        $visitor4 = new Visitor();
        $visitor4->setDateNaissance(new \DateTime('2015/02/02'));
        $visitor4->setReduit(0);

        $reservation->addVisitor($visitor1);
        $reservation->addVisitor($visitor2);
        $reservation->addVisitor($visitor3);
        $reservation->addVisitor($visitor4);
        

        //chargement du service
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();
        $PriceCalculation = $container->get('pw_louvre.priceCalculation');


        $PriceCalculation->setPrice($reservation);

        $resultat = $reservation->getPrixTotal();

        $this->assertEquals(40, $resultat);
    }

    public function testComplex()
    {

        //reservation 2 adultes(1 reduit) 1 plus de 60 ans 1 enfant 1 moins de 4ans demi journée
        $reservation = new Reservation();
        $reservation->setDemi(0);

        $visitor1 = new Visitor();
        $visitor1->setDateNaissance(new \DateTime('1985/01/01'));
        $visitor1->setReduit(1);
        $visitor2 = new Visitor();
        $visitor2->setDateNaissance(new \DateTime('1986/07/12'));
        $visitor2->setReduit(0);
        $visitor3 = new Visitor();
        $visitor3->setDateNaissance(new \DateTime('2009/11/19'));
        $visitor3->setReduit(0);
        $visitor4 = new Visitor();
        $visitor4->setDateNaissance(new \DateTime('2015/02/02'));
        $visitor4->setReduit(0);
        $visitor5 = new Visitor();
        $visitor5->setDateNaissance(new \DateTime('1956/02/02'));
        $visitor5->setReduit(0);

        $reservation->addVisitor($visitor1);
        $reservation->addVisitor($visitor2);
        $reservation->addVisitor($visitor3);
        $reservation->addVisitor($visitor4);
        $reservation->addVisitor($visitor5);
        

        //chargement du service
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();
        $PriceCalculation = $container->get('pw_louvre.priceCalculation');


        $PriceCalculation->setPrice($reservation);

        $resultat = $reservation->getPrixTotal();

        $this->assertEquals(23, $resultat);
    }

    public function testMoreComplex()
    {

        //reservation 2 adultes(1 reduit) 2 plus de 60 ans (1 réduit) 2 enfants (1 réduit) 1 moins de 4ans demi journée
        $reservation = new Reservation();
        $reservation->setDemi(0);

        $visitor1 = new Visitor();
        $visitor1->setDateNaissance(new \DateTime('1985/01/01'));
        $visitor1->setReduit(1);
        $visitor2 = new Visitor();
        $visitor2->setDateNaissance(new \DateTime('1986/07/12'));
        $visitor2->setReduit(0);
        $visitor3 = new Visitor();
        $visitor3->setDateNaissance(new \DateTime('2009/11/19'));
        $visitor3->setReduit(1);
        $visitor4 = new Visitor();
        $visitor4->setDateNaissance(new \DateTime('2015/02/02'));
        $visitor4->setReduit(0);
        $visitor5 = new Visitor();
        $visitor5->setDateNaissance(new \DateTime('1956/02/02'));
        $visitor5->setReduit(0);
        $visitor6 = new Visitor();
        $visitor6->setDateNaissance(new \DateTime('1948/12/02'));
        $visitor6->setReduit(1);
        $visitor7 = new Visitor();
        $visitor7->setDateNaissance(new \DateTime('2008/05/19'));
        $visitor7->setReduit(0);

        $reservation->addVisitor($visitor1);
        $reservation->addVisitor($visitor2);
        $reservation->addVisitor($visitor3);
        $reservation->addVisitor($visitor4);
        $reservation->addVisitor($visitor5);
        $reservation->addVisitor($visitor6);
        $reservation->addVisitor($visitor7);
        

        //chargement du service
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();
        $PriceCalculation = $container->get('pw_louvre.priceCalculation');


        $PriceCalculation->setPrice($reservation);

        $resultat = $reservation->getPrixTotal();

        $this->assertEquals(32, $resultat);
    }
}
