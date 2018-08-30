<?php

namespace AppBundle\Services;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserService
 * @package AppBundle\Services
 */
class UserService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var EmailProvider
     */
    private $emailProvider;

    /**
     * @var EmailSender
     */
    private $emailSender;

    /**
     * @var ActivationCodeGenerator
     */
    private $activationCodeGenerator;

    /**
     * EmailProvider constructor.
     * @param EntityManagerInterface $em
     * @param EmailProvider $emailProvider
     * @param EmailSender $emailSender
     * @param ActivationCodeGenerator $activationCodeGenerator
     */
    public function __construct(
        EntityManagerInterface $em,
        EmailProvider $emailProvider,
        EmailSender $emailSender,
        ActivationCodeGenerator $activationCodeGenerator
    ) {
        $this->em = $em;
        $this->emailProvider = $emailProvider;
        $this->emailSender = $emailSender;
        $this->activationCodeGenerator = $activationCodeGenerator;
    }

    /**
     * @param User $user
     */
    public function activateUser(User $user)
    {
        // activate user
        // TODO: activate user

        // send greeting email
        $email = $this->emailProvider->getEmail('user.hello', [
            'username' => $user->getEmail(),
            'code' => $this->activationCodeGenerator->generateCode(),
        ]);

        $this->emailSender->sendEmail($email, $user->getEmail());
    }
}
