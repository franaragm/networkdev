<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackendBundle\Entity\User;
use BackendBundle\Entity\Follow;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class FollowController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * Persiste en la entidad Follow los datos del usuario en la sesion y
     * el usuario que se sigue que se determina mediante una peticion request
     *
     * @param Request $request
     * @return Response
     */
    public function followAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();

        if (!$isAjax) {
            return $this->redirect("people");
        }

        $user = $this->getUser();
        $followed_id = $request->get('followed'); // id de usuario que se va a seguir

        $em = $this->getDoctrine()->getManager();
        $user_repo = $em->getRepository('BackendBundle:User');
        $followed = $user_repo->find($followed_id);

        $follow = new Follow();
        $follow->setUser($user);
        $follow->setFollowed($followed);

        $em->persist($follow);
        $flush = $em->flush();

        if ($flush == null){
            $status = "Ahora estas siguiendo a este Usuario";
        }else{
            $status = "No se ha podido seguir a este Usuario";
        }

        return new Response($status);

    }

    /**
     * Borra un registro de seguimiento usando entidad Follow, usuario logeado y
     * parametro request de id de usuario que se sigue.
     *
     * @param Request $request
     * @return Response
     */
    public function unfollowAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();

        if (!$isAjax) {
            return $this->redirect("people");
        }

        $user = $this->getUser();
        $followed_id = $request->get('followed'); // id de usuario que se va a seguir

        $em = $this->getDoctrine()->getManager();
        $follow_repo = $em->getRepository('BackendBundle:Follow');
        $followed = $follow_repo->findOneBy(array(
            'user' => $user,
            'followed' => $followed_id
        ));

        $em->remove($followed);
        $flush = $em->flush();

        if ($flush == null){
            $status = "Has dejado de seguir a este Usuario";
        }else{
            $status = "No se ha podido dejar de seguir a este Usuario";
        }

        return new Response($status);

    }
}
