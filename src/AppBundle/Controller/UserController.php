<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use BackendBundle\Entity\User;
use AppBundle\Form\RegisterType;


class UserController extends Controller
{

    private $session;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * Autentificacion de usuarios usando el servicio de Symfony
     *
     * @param Request $request
     * @return $this
     */
    public function loginAction(Request $request)
    {
        // si el usuario esta logueado se redirecciona a /home
        if (is_object($this->getUser())) {
            return $this->redirect('home');
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        // informacion de usuario que falla en autentificacion
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AppBundle:User:login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error
        ));
    }

    /**
     * Carga vista con formulario definido en clase RegisterType
     * Configura datos de formulario en objeto User y el password cifrado
     * Usa session para poder mostrar mensajes en el proceso de registro.
     *
     * @param Request $request
     * @return $this
     */
    public function registerAction(Request $request)
    {
        // si el usuario esta logueado se redirecciona a /home
        if (is_object($this->getUser())) {
            return $this->redirect('home');
        }

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        // configura datos de envio del formulario en objeto user
        $form->handleRequest($request);
        // procesado de envio de form de registro
        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                // $user_repo = $em->getRepository("BackendBundle:User");

                $query = $em->createQuery('SELECT u FROM BackendBundle:User u WHERE u.email = :email OR u.nick = :nick')
                ->setParameter('email', $form->get("email")->getData())
                ->setParameter('nick', $form->get("nick")->getData());

                $user_isset = $query->getResult();

                if (count($user_isset) == 0){

                    // codificacion de password
                    $factory = $this->get("security.encoder_factory");
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get("password")->getData(), $user->getSalt());

                    // configurar datos restantes del objeto User
                    $user->setPassword($password);
                    $user->setRole("ROLE_USER");
                    $user->setImage(null);

                    $em->persist($user);
                    $flush = $em->flush();//guardar en BD

                    if ($flush == null){
                        $status = "Te has registrado correctamente";

                        $this->session->getFlashBag()->add("status", $status);
                        return $this->redirect("login");
                    } else {
                        $status = "Error al registrar";
                    }

                } else {
                    $status = "El usuario ya existe !!";
                }

            } else {
                $status = "No te has registrado correctamente !!";
            }

            $this->session->getFlashBag()->add("status", $status);
        }

        // crea vista con formulario
        return $this->render('AppBundle:User:register.html.twig', array(
            "form" => $form->createView()
        ));
    }

    /**
     * Método que recoge el dato nick del form de registro via AJAX
     * comprueba si nick esta en uso o no , devuelve una respuesta http con un string
     *
     * @param Request $request
     * @return Response
     */
    public function nickTestAction(Request $request)
    {
        $nick = $request->get("nick");

        $em = $this->getDoctrine()->getManager();
        $user_repo = $em->getRepository("BackendBundle:User");
        $user_isset = $user_repo->findOneBy(array("nick" => $nick));

        $result = "used";
        if (count($user_isset) >= 1 && is_object($user_isset)){
            $result = "used";
        } else {
            $result = "unused";
        }

        return new Response($result);
    }

}
