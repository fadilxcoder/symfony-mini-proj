<?php

namespace App\Mailer;

use App\Entity\User;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class AuthMailer
{
	private $mailerInterface;
	private $fromAddress;
	private $parameterBagInterface;
	private $translatorInterface;

	public function __construct(
		MailerInterface $mailerInterface,
		ParameterBagInterface $parameterBagInterface,
		TranslatorInterface $translatorInterface
	) {
		$this->fromAddress = $_ENV['MAILER_FROM'];
		$this->mailerInterface = $mailerInterface;
		$this->parameterBagInterface = $parameterBagInterface;
		$this->appName = $this->parameterBagInterface->get('application_name');
		$this->translatorInterface = $translatorInterface;
	}

	public function dispatchEmail(User $user)
	{
		try {
			$subject  = $this->translatorInterface->trans('connexion.subject', ['%application_name%' => $this->appName], 'emails');
			$date = new \DateTime("now");

			$email = (new TemplatedEmail())
				->from($this->fromAddress)
				->to(new Address($user->getEmail()))
				->replyTo($this->fromAddress)
				->priority(Email::PRIORITY_NORMAL)
				->subject($subject)
				
				// path of the Twig template to render
				->htmlTemplate('emails/login_detected.html.twig')

				// pass variables (name => value) to the template
                ->context([
                    'time' => $date->format('d-m-Y H:i'),
                    'user' => $user,
					'application_name' => $this->appName
                ]);
			;
			$this->mailerInterface->send($email);

			return true;
		} 
		catch (TransportExceptionInterface $e) {
			return $e;
		}
	}
}