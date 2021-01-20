<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

// Cargamos el paquete Response para poder devolver una respuesta
use Symfony\Component\HttpFoundation\Response;

// Cargamos el modelo de Animal
use App\Entity\Animal;

// Para poder trabajar con formularios es necesario cargar las siguientes clases
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

// Cargamos esta clase para poder crear variables de sesión y poder hacer mensajes flash (necesario para hacerlo de la forma 2)
use Symfony\Component\HttpFoundation\Session\Session;

// Si el formulario lo tenemos definido en una clase externa (carpeta Form), es necesario cargarlo aquí para poder utilizarlo y pasárselo a la vist
use App\Form\AnimalType;

// Librerías necesarias para validar datos si queremos usarlas sin utilizar el @Assert del modelo
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Email;

class AnimalController extends AbstractController
{
    // En este método vamos a ver ejemplos de algunos métodos de doctrine, el query builder, el DQL, etc... de symfony
    public function index()
    {
        // Cargamos el repositorio del modelo
        $animal_repository = $this->getDoctrine()->getRepository(Animal::class);
        
        // Uso del findAll() para que me saque todos los registros
        $animales = $animal_repository->findAll();
        
        // Uso del findOneBy() para hacer búsquedas filtrando: sólo saca 1 registro
        $animal = $animal_repository->findOneBy([
            'tipo' => 'Cobra'
        ]);
        
        //dd($animal);
        
        // Uso del findBy() para hacer búsquedas filtrando: saca múltiples registros. Si le pasamos un segundo parámetro podemos hacer un order by
        $animales_africanos = $animal_repository->findBy([
            'raza' => 'africana'
        ], [
            'id' => 'DESC'
        ]);
        
        //dd($animales_africanos);
        
        
        
        // Query Builder
        
        // Montamos la consulta
        $qb = $animal_repository->createQueryBuilder('a')
                                ->andWhere('a.raza = :raza')
                                ->setParameter('raza', 'australiano')
                                ->orderBy('a.id', 'DESC')
                                ->getQuery();
        
        // Y la ejecutamos guardando el resultado en una variable, array, etc...
        $resultset = $qb->execute();
        
        //dd($resultset);
        
        
        
        
        // DQL (necesario el entity manager)
        $dql = "SELECT a FROM App\Entity\Animal a WHERE a.raza = :raza";
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql)->setParameter('raza', 'americana');
        $resultset = $qb->getResult();
        
        //dd($resultset);
        
        
        
        // SQL: También se pueden ejecutar sentencias SQL normales
        $connection = $this->getDoctrine()->getConnection();
        $query = "SELECT * FROM animales ORDER BY id DESC";
        $prepare = $connection->prepare($query);
        $prepare->execute();
        $resultset = $prepare->fetchAll();  // El método fetch() sólo me saca uno
        dd($resultset);
        
        
        return $this->render('animal/index.html.twig', [
            'controller_name' => 'AnimalController',
            'animales' => $animales
        ]);
    }
    
    // Método para ver cómo se hace un insert de un registro en la base de datos
    public function save(){
        // Para poder trabajar con las entidades y la bbdd, necesitamos el entity manager
        $em = $this->getDoctrine()->getManager();
        
        // Nos creamos un objeto Animal
        $animal = new Animal();
        
        // Seteamos los datos
        $animal->setTipo('Avestruz');
        $animal->setColor('negro');
        $animal->setRaza('africana');
        
        // Guardamos objeto en doctrine (persistimos los cambios)
        $em->persist($animal);
        
        // Guardar en la bbdd: 
        $em->flush();
                
        return new Response('Animal creado correctamente con id' . $animal->getId());
    }
    
    // Método para ver cómo se hace una búsqueda de un registro en la base de datos
    public function animal($id){
        // Cargamos el repositorio del modelo
        $animal_repository = $this->getDoctrine()->getRepository(Animal::class);
        
        // Ejemplo de uso del find()
        $animal = $animal_repository->find($id);
        
        // Comprobamos si el resultado es correcto
        if($animal){
            $message = 'El animal que has buscado es ' . $animal->getTipo() . ', de color ' . $animal->getColor() . ', raza ' . $animal->getRaza() . ' y tiene el ID = ' . $animal->getId();
        }else{
            $message = "El animal no existe";
        }
        
        return new Response($message);
    }
    
    // Método para ver cómo se hace el update y cómo podemos sacar automáticamente un objeto de la bbdd sin necesidad de hacer un find previamente
    // Para hacer esto, le indicamos al método que vamos a recibir un objeto del tipo animal en este caso. Como en la ruta especificamos que ese
    // parámetro va a ser el id, Symfony ya me va a sacar el objeto animal directamente según el id que le pasemos por la url
    public function update(Animal $animal){       
        
        // Comprobamos si el objeto animal me llega
        if(!$animal){
            $message = "El animal no existe en la bbdd";
        }else{

            // Cargamos el entity manager
            $em = $this->getDoctrine()->getManager();

            // Asignamos los valores al objeto
            $animal->setTipo('Gorila Talibán');
            $animal->setColor('gris');

            // Guardamos objeto en doctrine (persistimos los cambios)
            $em->persist($animal);

            // Guardar en la bbdd: 
            $em->flush();
            
            $message = "Los datos del animal se han actualizado correctamente";
        }
        
        return new Response($message);
    }
    
    // Método para ver cómo se hace el borrado en bbdd. 
    // Aquí también usamos lo que hemos hecho antes en el update (pasarle un objeto animal como parámetro) que nos ahorra mucho código
    public function delete(Animal $animal){
        
        if($animal && is_object($animal)){
            // Cargamos el entity manager
            $em = $this->getDoctrine()->getManager();

            // Borramos el objeto animal
            $em->remove($animal);

            // Guardamos los cambios en la bbdd: 
            $em->flush();

            $message = "Animal borrado correctamente";
        }else{
            $message = "El animal no existe en la bbdd";
        }
        
        return new Response($message);
    }
    
    // Método para ver cómo se crea un formulario para poder pasárselo a la vista y que se renderice allí
    // PODEMOS CREAR EL FORMULARIO AQUÍ O IMPORTARLO DE LA CARPETA FORM.
    // Dejo comentado el código donde me creo el formulario para usar el AnimalType.php de la carpeta Form (necesario ser importado arriba)
    public function crearAnimal(Request $request){
        // Nos creamos un objeto nuevo
        $animal = new Animal();
        
        
        /*  COMENTO ESTA PARTE PORQUE EL FORMULARIO LO VAMOS A CARGAR DESDE LA CLASE ANIMALTYPE
        
        // Nos creamos un nuevo formulario con el FormBuilder que recibirá el objeto como parámetro.
        // Podemos pasarle un action si queremos que los datos que se recogen en el formulario sean enviados a otra acción. 
        // Si no se lo pasamos, por defecto se envían al mismo método (o sea aquí crearAnimal())
        // Aunque por defecto el método http de los formularios sea POST, también podemos indicarle el method por si es distinto (no en este caso)
        // Deberemos pasarle los campos que va a tener el formulario. Todos los campos pueden recibir como tercer parçametro un array donde podemos
        // cambiarles atributos.
        $form = $this->createFormBuilder($animal)
                    // ->setAction($this->generateUrl('animal_save'))  // Los datos que se envíen en el formulario serán recogidos por la acción de la ruta con el name 'animal_save'
                     ->setMethod('POST')  // Podemos especificarle también el método http. Por defecto es POST (aunque aqui sea redundante ponerlo)
                     ->add('tipo', TextType::class, [
                         'label' => 'Tipo de animal'
                     ])
                     ->add('color', TextType::class)
                     ->add('raza', TextType::class)
                     ->add('submit', SubmitType::class, [
                         'label' => 'Crear Animal',
                         'attr' => ['class' => 'btn btn-success']
                     ])
                     ->getForm();
        */
        
        // Nos creamos una variable form con el formualario que hemos hecho en el AnimalType pasándole el objeto animal como parámetro
        $form = $this->createForm(AnimalType::class, $animal);
        
        // Cogemos los datos enviados en el formulario con el método handleRequest() pasándole la request como parámetro
        $form->handleRequest($request);
        
        // Comprobamos si el formulario se ha enviado y ha pasado la validación
        if($form->isSubmitted() && $form->isValid()){
            // Symfony ya me hace el seteo de cada atributo del objeto animal con los valores de cada campo. De esta manera, si todo es correcto, 
            // el objeto animal que nos hemos creado antes ya estará completo. 
            // Lo único que nos quedará será persistir el objeto y guardarlo en la bbdd
            
            // Cargamos el entity manager
            $em = $this->getDoctrine()->getManager();
            
            // Persistimos los cambios
            $em->persist($animal);

            // Guardar en la bbdd: 
            $em->flush();
            
            // SESIÓN FLASH
            //FORMA 1: Sin necesidad de crearse una variable de sesión
            /*
            $this->addFlash(
                'notice',
                'Tus cambios se han guardado!'
            );
            */
            
            // FORMA 2: Creando una variable de sesión (necesario cargar la clase Session haciendo el use Session de arriba)
            $session = new Session();
            $session->getFlashBag()->add('message', 'Animal creado');
            
            return $this->redirectToRoute('animal_create');  // Hacemos una redirección a la misma página pero con el formulario en blanco
        }
        
        
        return $this->render('animal/crear-animal.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    // Método para ver otra forma de validar datos sin usar el @Assert del campo en el modelo de la entidad
    // En este caso nos hemos creado una ruta que llama a este controlador y le pasa un parámetro email por la URL
    // Usaremos la librería Validator para ello (necesario cargarla/importarla arriba).
    // Si queremos ver todas las constraints que la librería tiene buscar en google "Validation Constraints Reference"
    public function validarEmail($email){
        // Nos creamos un objeto Validator
        $validator = Validation::createValidator();
        
        // Usamos el método validate y le pasamos por parámetro el email que me llega por la url y le digo que me aplique una validación de email
        $errores = $validator->validate($email, [
            new Email()
        ]);
        
        if(count($errores) != 0){
            echo "El email no ha pasado la validación <br />";
            
            foreach($errores as $error){
                echo $error->getMessage() . "<br />";
            }
        }else{
            echo "Email validado correctamente";
        }
        
        die();
    }
}
