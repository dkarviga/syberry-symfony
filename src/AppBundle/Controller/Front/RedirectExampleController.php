<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RequestExampleController
 * @package AppBundle\Controller\Front
 */
class RedirectExampleController extends Controller
{
    /**
     * @param int $action
     * @return Response
     */
    public function indexAction(int $action): Response
    {
        if ($action == 1) {
            // redirects to the "homepage" route
            return $this->redirectToRoute('homepage');

            // redirectToRoute is a shortcut for:
            // return new RedirectResponse($this->generateUrl('homepage'));
        }

        if ($action == 2) {
            // does a permanent - 301 redirect
            return $this->redirectToRoute('homepage', array(), 301);
        }

        if ($action == 3) {
            // redirect to a route with parameters
            return $this->redirectToRoute('app_lucky_number', array('max' => 10));
        }

        // redirects externally
        return $this->redirect('http://symfony.com/doc');
    }
}
