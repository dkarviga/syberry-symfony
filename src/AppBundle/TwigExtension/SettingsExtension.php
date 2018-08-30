<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/23/2018
 * Time: 1:40 PM
 */

namespace AppBundle\TwigExtension;

use AppBundle\Services\SettingsService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class SettingsExtension extends AbstractExtension
{
    /**
     * @var SettingsService
     */
    private $settingService;

    /**
     * SettingsExtension constructor.
     * @param SettingsService $settingService
     */
    public function __construct(SettingsService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('setting', array($this, 'settingFunction'))
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('setting',  array($this, 'settingFunction'))
        ];
    }

    public function settingFunction($paramName) {
        return $this->settingService->getValue($paramName);
    }

}