<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Knp\Component\Pager\PaginatorInterface;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/new", name="task_create")
     * @Route("/{id}/edit", name="task_edit")
     */
    public function form(Task $task = null, Request $request, ObjectManager $manager)
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

        return $this->render('task/create.html.twig', [
            'formTask' => $form->createView(),
            'editMode' => $task->getId() !== null
        ]);

    }
}
