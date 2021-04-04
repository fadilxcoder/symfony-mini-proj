<?php

namespace App\Mailer;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class AuthMailer
{
	private $mailerInterface, $fromAddress;

	public function __construct(MailerInterface $mailerInterface)
	{
		$this->fromAddress = $_ENV['MAILER_FROM'];
		$this->mailerInterface = $mailerInterface;
	}

	public function dispatchEmail($toAddresses)
	{
		try {
			$email = (new Email())
				->from($this->fromAddress)
				->to(new Address($toAddresses))
				//->cc('cc@example.com')
				//->bcc('bcc@example.com')
				//->replyTo('fabien@example.com')
				//->priority(Email::PRIORITY_HIGH)
				->subject('Time for Symfony Mailer!')
				->text('Sending emails is fun again!')
				->html('<p>See Twig integration for better HTML integration!</p>')
			;
			$this->mailerInterface->send($email);

			return true;
		} 
		catch (TransportExceptionInterface $e) {
			return $e;
		}
	}
}