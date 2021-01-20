<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Task;
use App\Entity\User;

// Casrgamos el formulario de creación de tarea que nos hemos creado
use App\Form\TaskType;

// Cargamos el UserInterface para poder sacar el usuario identificado/logeado
use Symfony\Component\Security\Core\User\UserInterface;

class TaskController extends AbstractController
{
    
    // Método que saca el listado con todas las tareas guardadas en bbdd
    public function index(): Response
    {
        /*
        
        ESTA PARTE ESTÁ COMENTADA PORQUE ES UNA PRUEBA QUE HICE AL PRINCIPIO PARA COMPROBAR SI ESTABA BIEN HECHO EL MAPEO CON LAS RELACIONES
        
         * // Prueba de entidades y relaciones
        $em = $this->getDoctrine()->getManager();
        
        
        // PRUEBA 1: Desde las tareas(tasks), sacamos los users
        $task_repository = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $task_repository->findAll();
        
        foreach($tasks as $task){
            echo "{$task->getUser()->getEmail()}: {$task->getTitle()}<br />";
        }
        
        
        // PRUEBA 2: Desde Users, sacamos las tareas (Tasks)
        $user_repository = $this->getDoctrine()->getRepository(User::class);
        $users = $user_repository->findAll();
        
        foreach($users as $user){
            echo "<h1>{$user->getName()} {$user->getSurName()}</h1>";
            
            foreach($user->getTasks() as $task){
                echo "<h2>{$task->getTitle()}</h2>";
            }
        }
        */
        
        $em = $this->getDoctrine()->getManager();
        
        $task_repository = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $task_repository->findBy([], ['id' => 'DESC']);  // Le paso un array vacío para que me saque todas las tareas
        
        // Se mostrarán todas las tareas guardadas en la bbdd
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
            'titulo' => 'Todas las tareas'
        ]);
    }
    
    public function detail(Task $task){
        // Si no me llega la tarea por parámetro (id) hago una redirección
        if(!$task){
            return $this->redirectToRoute('tasks');
        }
        
        return $this->render('task/detail.html.twig', [
            'task' => $task
        ]);
    }
    
    public function createTask(Request $request, UserInterface $user){
        
        // Nos creamos un objeto de tipo Task
        $task = new Task();
        
        // Y se lo pasamos al formulario como parámetro 
        $form = $this->createForm(TaskType::class, $task);
        
        // Vinculamos el formulario al objeto Task con el método handleRequest para que cuando enviemos la información de los campos del formulario,
        // se rellenen los mismos campos del objeto. Debemos pasarle la request por parámetro
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            // Como hay algunos campos del objeto que no se recogen en el formulario, los seteamos ahora
            $today = new \Datetime('now');
            $task->setCreatedAt($today);
            
            // Seteamos el usuario identificado a la tarea
            $task->setUser($user);
            
            // Cargamos el entity manager
            $em = $this->getDoctrine()->getManager();
            
            // Persistimos
            $em->persist($task);
            
            // Guardamos en bbdd
            $em->flush();
            
            return $this->redirect(
                        $this->generateUrl('task_detail', [
                            'id' => $task->getId()
                        ])
                    );
        }
        
        return $this->render('task/create.html.twig', [
            'edit' => false,
            'form' => $form->createView()
        ]);
    }
    
    public function myTasks(UserInterface $user){
        // Sacamos las tareas del usuario identificado
        $tasks = $user->getTasks();
        
        // La plantilla del index la reutilizo (aquí y en el método index). 
        // Como le paso un array distinto con las tareas, me vale para ambas acciones.
        // Ahora sólo mostrará las tareas del usuario identificado
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
            'titulo' => 'Mis tareas'
        ]);
    }
    
    public function edit(Request $request, Task $task, UserInterface $user){
        
        // Sólo el usuario que haya creado la tarea podrá editarla. Si no lo es, me redirige al inicio
        if($task->getUser() != $user){
            return $this->redirectToRoute('tasks');
        }
        
        // Le pasamos la tarea al formulario como parámetro 
        $form = $this->createForm(TaskType::class, $task);
        
        // Vinculamos el formulario al objeto Task con el método handleRequest para que cuando enviemos la información de los campos del formulario,
        // se rellenen los mismos campos del objeto. Debemos pasarle la request por parámetro
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            // El usuario no lo seteamos porque ya comprobamos al principio que el usuario que está editando la tarea es el mismo 
            // que la ha creado. 
            // Si tuviésemos un campo updatedAt lo seteariamos, pero en este caso ese campo no existe asique nada.
            
            // Cargamos el entity manager
            $em = $this->getDoctrine()->getManager();
            
            // Persistimos
            $em->persist($task);
            
            // Guardamos en bbdd
            $em->flush();
            
            return $this->redirect(
                        $this->generateUrl('task_detail', [
                            'id' => $task->getId()
                        ])
                    );
        }
        
        // Reutilizamos la vista del createTask
        return $this->render('task/create.html.twig', [
            'edit' => true,
            'form' => $form->createView()
        ]);
    }
    
    public function delete(Task $task, UserInterface $user){
        // Sólo el usuario que haya creado la tarea podrá borrarla. Si no lo es, me redirige al inicio.
        // También me redirigirá si no le llega ninguna tarea
        if($task->getUser() != $user || !$task){
            return $this->redirectToRoute('tasks');
        }
        
        // Cargamos el entity manager
        $em = $this->getDoctrine()->getManager();

        // Borramos la tarea
        $em->remove($task);

        // Guardamos en bbdd
        $em->flush();
        
        return $this->redirectToRoute('tasks');
    }
}
