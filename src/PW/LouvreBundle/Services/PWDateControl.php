<?php

namespace PW\LouvreBundle\Services;

use PW\LouvreBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;
use \DateTimeZone;

class PWDateControl
{

	public function isDateCorrect(Request $request, Reservation $reservation)
	{

		$reservationDate = $reservation->getdate();
		
		// si c'est un jour férié
		$year = $reservationDate->format('Y');
		$forbiddenDate = ['01/05/' . $year, '01/11/' . $year, '25/12/' . $year];

		if (in_array($reservationDate->format('d/m/Y'), $forbiddenDate)){

			$request->getSession()->getFlashBag()->add('notice', 'Le musée n\'est pas ouvert les jours féries');

			return true;
		}

  		// si le jour est un mardi ou un dimanche
		if ($reservationDate->format('w') == 2 || $reservationDate->format('w') == 0){

			$request->getSession()->getFlashBag()->add('notice', 'La reservation n\'est pas disponible pour les mardis ou les dimanches');

			return true;
		}

		//si la reservation journée entière pour le jour même a été effectuée après 14h00
		$today = new DateTime('NOW', new DateTimeZone('Europe/Paris'));
		$todayDate = $today->format('d/m/Y');
		$todayHour = $today->format('H');

		if ($reservation->getDemi() == true && $reservationDate->format('d/m/Y') == $todayDate && $todayHour >= '14'){

			$request->getSession()->getFlashBag()->add('notice', 'La reservation journée entière n\'est pas disponible après 14h00');

			return true;
		}

		return false;
	}
}