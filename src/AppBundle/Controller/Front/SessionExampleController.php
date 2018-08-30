<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class RequestExampleController
 * @package AppBundle\Controller\Front
 */
class SessionExampleController extends Controller
{
    /**
     * @param SessionInterface $session
     * @return Response
     */
    public function indexAction(SessionInterface $session): Response
    {
        // stores an attribute for reuse during a later user request
        $session->set('foo', 'bar');

        // gets the attribute set by another controller in another request
        $foobar = $session->get('foobar');

        // uses a default value if the attribute doesn't exist
        $filters = $session->get('filters', array());

        return new Response('');
    }
}
