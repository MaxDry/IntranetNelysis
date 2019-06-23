<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Form\TaskType;
/**
* @Route("/task")
*/
class TaskController extends AbstractController
{
    /**
     * @Route("/", name="task")
     */
    public function index()
    {

        $repo = $this->getDoctrine()->getRepository(Task::class);

        $tasks = $repo->findAll();

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks
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
