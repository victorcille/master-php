<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

// Cargamos nuestro modelo de Usuario
use App\Entity\User;

// Casrgamos el formulario de registro que nos hemos creado
use App\Form\RegisterType;

// Cargamos la librería UserPasswordEncoderInterface para poder cifrar la password del usuario que se registra
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// Cargamos la librería AuthenticationUtils para poder hacer el login
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        // Nos creamos un objeto de tipo User
        $user = new User();
        
        // Y se lo pasamos al formulario como parámetro 
        $form = $this->createForm(RegisterType::class, $user);
        
        // Vinculamos el formulario al objeto User con el método handleRequest para que cuando enviemos la información de los campos del formulario,
        // se rellenen los mismos campos del objeto. Debemos pasarle la request por parámetro
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            // Como hay algunos campos del objeto que no se recogen en el formulario, los seteamos ahora
            $user->setRole('ROLE_USER');
            $today = new \Datetime('now');
            $user->setCreatedAt($today);
            
            // Ciframos la contraseña usando los encoders que tiene symfony (mirar el fichero config/packages/security.yaml).
            // El primer parámetro que recibe es el objeto sobre el cual quiero actuar, y como segundo parámetro la password en texto plano
            $pass_encoded = $encoder->encodePassword($user, $user->getPassword());
            
            // Seteamos la password ya cifrada
            $user->setPassword($pass_encoded);
            
            // Cargamos el entity manager
            $em = $this->getDoctrine()->getManager();
            
            // Persistimos
            $em->persist($user);
            
            // Guardamos en bbdd
            $em->flush();
            
            return $this->redirectToRoute('tasks');
        }
        
        // Le pasamos el forrmulario a la vista para que me lo renderice
        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    
    public function login(AuthenticationUtils $authenticationUtils){
        // En aso de que se produzca un error de autenticación nos lo guardamos en una variable $error
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // También podemos guardarnos, en caso de que se produzca un error,  el nombre del usuario que ha intentado autenticarse
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('user/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }
}
