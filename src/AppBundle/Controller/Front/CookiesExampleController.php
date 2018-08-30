<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RequestExampleController
 * @package AppBundle\Controller\Front
 */
class CookiesExampleController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        // retrieves a COOKIE value
        $request->cookies->get('PHPSESSID');

        //set cookie value
        $request->cookies->set('PHPSESSID', 'asflkasdgfaidgoiajvka');

        return new Response('');
    }
}
