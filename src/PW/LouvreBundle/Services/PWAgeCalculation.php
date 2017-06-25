<?php

namespace PW\LouvreBundle\Services;

use PW\LouvreBundle\Entity\Visitor;
use \DateTime;
use \DateTimeZone;

class PWAgeCalculation
{

	public function getAge(Visitor $visitor)
	{


		$year  = $visitor->getDateNaissance()->format('Y');
        $month = $visitor->getDateNaissance()->format('m');
        $day = $visitor->getDateNaissance()->format('d');

        $from = new DateTime( $year .'-' . $month . '-' . $day);

		$to   = new DateTime('today', new DateTimeZone('Europe/Paris'));

		$age = $from->diff($to)->y;

		return $age;
	}
}