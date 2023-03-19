<?php

namespace App\Service;

use App\Entity\Calculation;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function send(Calculation $calculation): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($calculation->getEmail())
            ->subject($calculation->getCompanySymbol()->getCompanyName())
            ->html(
                sprintf(
                    "<p>from %s to %s!</p> \n<p>Have fun!</p>",
                    $calculation->getStartDate()->format('Y-m-d'),
                    $calculation->getEndDate()->format('Y-m-d')
                )
            );

        $this->mailer->send($email);
    }
}
