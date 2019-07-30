<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskType;
use App\Repository\TaskRepository;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
* @Route("/task")
*/
class TaskController extends AbstractController
{
    /**
     * @Route("/", name="task")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $repo = $this->getDoctrine()->getRepository(Task::class);

        // $queryTasks = $repo->getTaskToDo('0');
        $queryTasks = $repo->findAll();

        $paginationTasks = $paginator->paginate(
            $queryTasks, 
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );

        return $this->render('task/index.html.twig', [
            'tasks' => $queryTasks,
            'paginationTasks' => $paginationTasks
        ]);
    }


    /**
     * @Route("/{id}/edit", name="task_edit")
     */
    public function update(Task $task = null, Request $request, ObjectManager $manager)
    {
        if(!$task){
            $task = new Task();
        }

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($task);
            $manager->flush();

            return $this->redirectToRoute('task');

        }

        return $this->render('task/update.html.twig', [
            'formTask' => $form->createView(),
            'task' => $task,
        ]);

    }

    /**
     * @Route("/new", name="task_create")
     */
    public function create(Task $task = null, Request $request, ObjectManager $manager)
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $task = new Task();
        
        $form = $this->createForm(TaskType::class, $task);

        dump($request);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($task);
            $manager->flush();

            return $this->redirectToRoute('task');

        }

        return $this->render('task/create.html.twig', [
            'formTask' => $form->createView(),
            'task' => $task,
            'users' => $users
        ]);

    }

    /**
     * @Route("/delete", name="task_delete")
     */
    public function delete(Request $request, TaskRepository $repoTask)
    {   
        $id = $request->request->get("value");

        $entityManager = $this->getDoctrine()->getManager();
        $task = $repoTask->findOneById($id);
       
        $entityManager->remove($task);
        $entityManager->flush();

        $data = [
             'result' => true
        ];

        return new JsonResponse($data);
    }

}
