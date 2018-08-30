<?php

namespace AppBundle\Services;

use AppBundle\Model\Email;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class EmailProvider
 * @package AppBundle\Services
 */
class EmailProvider
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var array
     */
    private $sender;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * EmailProvider constructor.
     * @param EngineInterface $templating
     * @param array $sender
     * @param array $config
     */
    public function __construct(EngineInterface $templating, array $sender, array $config)
    {
        $this->config = $config;
        $this->sender = $sender;
        $this->templating = $templating;
    }

    /**
     * @param string $key
     * @param array $params
     * @return Email
     */
    public function getEmail(string $key, array $params = []): Email
    {
        if (!array_key_exists($key, $this->config)) {
            throw new \RuntimeException('Email does not exist');
        }

        $emailConfig = $this->config[$key];

        $email = new Email(
            $emailConfig['subject'],
            $this->templating->render($emailConfig['template'], $params),
            $this->sender['email'],
            $this->sender['name']
        );

        return $email;
    }
}
