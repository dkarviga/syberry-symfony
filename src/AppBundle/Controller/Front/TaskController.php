<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/3/2018
 * Time: 3:15 PM
 */

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Task;
use AppBundle\Form\ChangeDueDateForm;
use AppBundle\Form\TaskForm;
use AppBundle\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TaskController
 * @package AppBundle\Controller\Front
 *
 * @Route("/tasks")
 */
class TaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @param TaskRepository $taskRepository
     * @required
     */
    public function setTaskRepository(TaskRepository $taskRepository): void
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @Route("/create", methods={"GET", "POST"}, name="create-task")
     *
     * @param Request $request
     * @return Response
     */
    public function createTask(Request $request): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskForm::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var $task Task
             */
            $task = $form->getData();
            $this->taskRepository->save($task);

            return $this->redirectToRoute('post-list');
        } else {
            return $this->render(
                'task/create.html.twig',
                [
                    'form' => $form->createView()
                ]
            );
        }
    }

    /*
    public function createJson(Request $request)
    {
        $task = new Task();

        $form = $this->createForm(TaskForm::class, $task);

        $data = json_decode($request->getContent(), true);

        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            var_dump($task);
            exit();
        } else {
            throw new BadRequestHttpException();
        }
    }*/

    /**
     * @Route("/{taskId}/change-due-date", name="task-change-due-date", methods={"POST", "GET"})
     * @param $taskId
     * @param Request $request
     * @return Response
     */
    public function changeDueDateAction($taskId, Request $request): Response
    {
        /**
         * @var Task $task
         */
        $task = $this->taskRepository->findOneById($taskId);

        if ($task != null) {
            $form = $this->createForm(ChangeDueDateForm::class, $task);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->taskRepository->save($task);
                return $this->redirectToRoute('post-list');
            } else {
                return $this->render('task/change_due_date.html.twig', [
                    'form' => $form->createView(),
                    'task' => $task
                ]);
            }
        } else {
            throw $this->createNotFoundException();
        }
    }

    /**
     * @Route("", name="post-list", methods={"GET"})
     */
    public function listAction(): Response
    {
        return $this->render('task/list.html.twig');
    }
}