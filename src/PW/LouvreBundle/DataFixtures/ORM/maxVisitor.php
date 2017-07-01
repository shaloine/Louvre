<?php

namespace PW\LouvreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PW\LouvreBundle\Entity\Reservation;

class LoadReservation implements FixtureInterface
{

  public function load(ObjectManager $manager)
  {


      $reservation = new Reservation();
      $reservation->setMail('test@hotmail.com');
      $reservation->setNombre(1000);
      $reservation->setDate(new \DateTime('2017/07/03'));
      $reservation->setDemi(true);
      $reservation->setPrixTotal(10);
      $reservation->setCode('abcdefgh');

      $manager->persist($reservation);

      $manager->flush();
  }
}