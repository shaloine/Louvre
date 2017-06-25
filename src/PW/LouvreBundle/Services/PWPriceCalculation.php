<?php

namespace PW\LouvreBundle\Services;

use PW\LouvreBundle\Entity\Reservation;

class PWPriceCalculation
{
	private $ageCalculation;

	public function __construct(\PW\LouvreBundle\Services\PWAgeCalculation $ageCalculation)
	{
		$this->ageCalculation    = $ageCalculation;
	}

	public function setPrice(Reservation $reservation)
	{

		$total = 0;
		$price = 16;
		
		foreach ($reservation->getVisitors() as $i => $visitor) {

			$age = $this->ageCalculation->getAge($visitor);

			if($age<4){
				$price = 0;
			}

			if($age>= 4 && $age < 12){
				$price = 8;
			}

			if($age>= 60){
				$price = 12;
			}

			if($visitor->getReduit() && $price>10){
				$price = 10;
			}

			if (!$reservation->getDemi() && $age>= 4){
				$price = $price/2;
			}

			$visitor->setPrix($price);


			$total += $price;

		}

		$reservation->setPrixTotal($total);
		
	}
}