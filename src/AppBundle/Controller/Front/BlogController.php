<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @package AppBundle\Controller\Front
 */
class BlogController extends Controller
{
    /**
     * @param int $page
     * @return Response
     *
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"}, defaults={"page"=1})
     */
    public function listAction(int $page): Response
    {
        return new Response("$page");
    }

    /**
     * @param string $slug
     * @return Response
     *
     * @Route("/blog/{slug}", name="blog_show")
     */
    public function showAction(string $slug): Response
    {
        return new Response(
            "showActionMethod"
        );
    }

    /**
     * @param string $_locale
     * @param int $year
     * @param string $slug
     * @return Response
     *
     * @Route(
     *     "/articles/{_locale}/{year}/{slug}.{_format}",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "_locale": "en|fr",
     *         "_format": "html|rss",
     *         "year": "\d+"
     *     }
     * )
     */
    public function articleAction(string $_locale, int $year, string $slug): Response
    {
        // ...
    }
}
