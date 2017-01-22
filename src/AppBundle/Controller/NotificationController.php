<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{

    /**
     * Muestra vista con las notificaciones del usuario logueado
     * y marca notificaciones como leidas
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function notificationsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $user_id = $user->getId();

        // se usa id de usuario en la consulta ya que la entidad tiene toString que devuelve nombre del usuario
        // notificaciones que van dirigidas a un usuario indicado en este caso el usuario logueado
        $dql = "SELECT n FROM BackendBundle:Notification n WHERE n.user = $user_id ORDER BY n.id DESC";
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), // parametro request de paginacion y en que num de pagina empieza
            5 //numero de registros por paginas
        );

        // marca notificaciones como leidas
        $notification = $this->get('app.notification_service');
        $notification->read($user);

        return $this->render('AppBundle:Notification:notifications.html.twig', array(
            'profile_user' => $user,
            'notifications' => $pagination
        ));

    }

    /**
     * Devuelve el número de notificaciones para el usuario logueado
     * mediante AJAX se llama a la ruta de este método y el valor de respuesta
     * se muestra en el layout
     *
     * @param Request $request
     * @return Response
     */
    public function countNotificationsAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();

        if (!$isAjax) {
            // si se indica ../ redirecciona a /notifications
            // si no se indica redirecciona a /notifications/notifications
            return $this->redirect("../notifications");
        }

        $em = $this->getDoctrine()->getManager();
        $notification_repo = $em->getRepository("BackendBundle:Notification");

        $notifications = $notification_repo->findBy(array(
            'user' => $this->getUser(),
            'readed' => 0
        ));

        return new Response(count($notifications));
    }
}
