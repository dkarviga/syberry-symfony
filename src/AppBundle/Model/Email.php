<?php

namespace AppBundle\Model;

class Email
{
    private $subject;

    private $text;

    private $fromEmail;

    private $fromName;

    public function __construct(string $subject, string $text, string $fromEmail, string $fromName)
    {
        $this->subject = $subject;
        $this->text = $text;
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getFromEmail(): string
    {
        return $this->fromEmail;
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->fromName;
    }
}
