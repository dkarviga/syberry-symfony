<?php

namespace AppBundle\Services;

/**
 * Class ActivationCodeGenerator
 * @package AppBundle\Services
 */
class ActivationCodeGenerator
{
    /**
     * @return string
     */
    public function generateCode(): string
    {
        return (string)rand(1e5, 1e6 - 1);
    }
}
