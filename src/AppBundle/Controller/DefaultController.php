<?php

namespace AppBundle\Controller;

use AppBundle\Model\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 *
 * @Route("/default")
 */
class DefaultController extends Controller
{
    private $flashBag;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * DefaultController constructor.
     * @param FlashBagInterface $flashBag
     * @param TranslatorInterface $translator
     */
    public function __construct(
        FlashBagInterface $flashBag,
        TranslatorInterface $translator
    )
    {
        $this->flashBag = $flashBag;
        $this->translator = $translator;
    }


    /**
     * @Route("/users/{userId}", methods={"GET"}, name="home-page")
     *
     * @param Request $request
     * @return Response
     */
    public function viewUserProfileAction($userId)
    {
        if ($userId % 10 != 0) {

            // replace this example code with whatever you need
            $response = new Response(
                ''
            );

            $response->headers->setCookie(
                new Cookie(
                    'mycookie',
                    'value'
                )
            );

            return $response;
        } else {
            throw $this->createNotFoundException('User Not Found');
        }
    }

    /**
     * @Route("/uploadfile", methods={"POST"})
     */
    public function uploadFileAction(Request $request) {
        $file = $request->files->get('lecture');

        var_dump($file);
        exit();
    }


    /**
     * @Route("/getjson", methods={"GET"}, name="get-json")
     */
    public function getJsonAction(Request $request) {
        $file = $request->files->get('lecture');

        $result = [
            'key1' => 'value1',
            'key2' => 'value5',
            'key3' => 'value8',
            'key4' => 'value1',
        ];

        return new JsonResponse($result);
    }

    /**
     * @Route("/{_locale}/getlocale/{userName}/{count}", name="getlocale", methods={"GET"}, requirements={"_locale"="ru|en"})
     * @Route("/getlocale/{userName}/{count}", name="getlocale_en", methods={"GET"})
     * @param Request $request
     * @param $userName
     * @param $count
     * @return Response
     */
    public function getLocaleAction(Request $request, $userName, $count) {
        return $this->render('default/getlocale.html.twig', [
            'locale' => $request->getLocale(),
            'userName' => $userName,
            'count' => $count
        ]);
    }

    /**
     * @Route("/redirectme", name="redirect-action")
     * @param $userId
     *
     * @return Response
     */
    public function redirectAction()
    {
        return $this->redirect('https://tut.by');
    }

    /**
     * @Route("/target", name="target")
     */
    public function targetAction()
    {

        $product = new Product();
        return new Response('I\'m redirected');
    }

}
