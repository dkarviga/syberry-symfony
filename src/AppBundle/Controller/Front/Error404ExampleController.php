<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RequestExampleController
 * @package AppBundle\Controller\Front
 */
class Error404ExampleController extends Controller
{
    /**
     * @param null $id
     * @return Response
     */
    public function indexAction($id = null): Response
    {
        if (!$id) {
            throw $this->createNotFoundException('The product does not exist');
        }

        return new Response('');
    }
}
