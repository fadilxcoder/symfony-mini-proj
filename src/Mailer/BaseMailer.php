<?php

namespace App\Mailer;

use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class BaseMailer
{
  /**
     * @param $from
     * @param $to
     * @param $subject
     * @param $template
     * @param array $context
     * @return TemplatedEmail
     */
    public static function getEmailObject($from, $to, $subject, $template, array $context = [])
    {
        if (!is_array($to)) {
            $to = [$to];
        }

        $toEmail = $to[0];
        unset($to[0]);

        $templateEmail = (new TemplatedEmail())
            ->from($from)
            ->to(new Address($toEmail));

        if (!empty($to)) {
            foreach ($to as $item) {
                $templateEmail->addTo($item);
            }
        }

        $templateEmail->subject($subject)

            // path of the Twig template to render
            ->htmlTemplate($template)

            // pass variables (name => value) to the template
            ->context($context);

        return $templateEmail;
    }
}