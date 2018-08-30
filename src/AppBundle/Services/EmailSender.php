<?php

namespace AppBundle\Services;

use AppBundle\Model\Email;

/**
 * Class EmailSender
 * @package AppBundle\Services
 */
class EmailSender
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @required
     *
     * @param \Swift_Mailer $mailer
     */
    public function setMailer(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Email $email
     * @param string $toEmail
     *
     * @return int
     */
    public function sendEmail(Email $email, string $toEmail)
    {
        $message = (new \Swift_Message($email->getSubject()))
            ->setFrom($email->getFromEmail())
            ->setTo($toEmail)
            ->setBody($email->getText(), 'text/html')
        ;

        return $this->mailer->send($message);
    }
}
