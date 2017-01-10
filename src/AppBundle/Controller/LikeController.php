<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use BackendBundle\Entity\User;
use BackendBundle\Entity\Publication;
use BackendBundle\Entity\Like;

class LikeController extends Controller
{

    /**
     * Guarda los likes de publicaciones que el usuario hace
     * Se usa AJAX, el id se recibe por URL en una llamada AJAX
     *
     * @param null $id
     * @return Response
     */
    public function likeAction($id = null)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $publication_repo = $em->getRepository('BackendBundle:Publication');
        $publication = $publication_repo->find($id);

        $like = new Like();
        $like->setUser($user);
        $like->setPublication($publication);

        $em->persist($like);
        $flush = $em->flush();

        if($flush == null) {
            $status = 'Te gusta esta publicación!';
        } else {
            $status = 'No se ha podido guardar el Me Gusta';
        }

        return new Response($status);
    }

    /**
     * Elimina los likes de publicaciones que el usuario hace
     * Se usa AJAX, el id publication se recibe por URL en una llamada AJAX
     *
     * @param null $id
     * @return Response
     */
    public function dislikeAction($id = null)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $like_repo = $em->getRepository('BackendBundle:Like');
        $like = $like_repo->findOneBy(array(
            'user' => $user,
            'publication' => $id
        ));

        $em->remove($like);
        $flush = $em->flush();

        if($flush == null) {
            $status = 'Ya no te gusta esta publicación!';
        } else {
            $status = 'No se ha podido quitar el Me Gusta';
        }

        return new Response($status);
    }

}
