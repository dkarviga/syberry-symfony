<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/23/2018
 * Time: 11:49 AM
 */

namespace AppBundle\Controller;

use AppBundle\Services\SettingsService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SettingsController extends Controller
{
    /**
     * @var SettingsService
     */
    private $settingService;

    /**
     * SettingsController constructor.
     * @param SettingsService $settingService
     */
    public function __construct(SettingsService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * @Route("/settings/{paramName}", methods={"PUT", "POST"}, name="set-settings")
     * @param Request $request
     * @return Response
     */
    public function setSettingAction(Request $request, $paramName)
    {
        $value = $request->get('value');


        $this->settingService->setValue($paramName, $value);

        return new Response($value);
    }

    /**
     * @Route("/settings/{paramName}", methods={"GET"}, name="get-settings")
     * @Template("settings/getsettings.html.twig")
     * @param $paramName
     * @return array
     */
    public function getSettingsAction($paramName)
    {
        $value = $this->settingService->getValue($paramName);

        $value = '<b>6</b>';
        return [
            'value' => $value
        ];
    }
}