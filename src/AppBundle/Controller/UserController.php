<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Services\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class UserController
 * @package AppBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @Route("/activate", name="one")
     *
     * @param Request $request
     * @param UserService $userService
     * @return Response
     */
    public function activateAction(Request $request, UserService $userService)
    {
        if (!$request->get('email')) {
            throw new BadRequestHttpException('Email parameter is missing');
        }

        $user = $this->getUserByEmail($request->get('email'));

        $userService->activateUser($user);

        // replace this example code with whatever you need
        return $this->render('default/activate_user.html.twig', [
            'user' => $user->getEmail(),
        ]);
    }

    /**
     * @param string $email
     * @return User
     */
    private function getUserByEmail(string $email)
    {
        $user = (new User())->setEmail($email);

        return $user;
    }
}
