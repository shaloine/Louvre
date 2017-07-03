<?php

namespace PW\LouvreBundle\Services;

use PW\LouvreBundle\Entity\Reservation;

class PWMailerService
{
	protected $mailer;
	protected $templating;
 
    public function __construct(\Swift_Mailer $mailer, $templating)
    {
    $this->mailer = $mailer;
    $this->templating = $templating;
    }

	public function send($reservation)
	{
		$message = \Swift_Message::newInstance()
        ->setSubject('sujet')
        ->setFrom('contact@louvre.com')
        ->setTo('shaloine2@hotmail.com') //->setTo($reservation->getMail())
        ->setBody(
        	$this->templating->render(
                'PWLouvreBundle:Emails:confirmation.html.twig',
                array('reservation' => $reservation)
            ),
            'text/html');
        $this->mailer->send($message);
	}
}