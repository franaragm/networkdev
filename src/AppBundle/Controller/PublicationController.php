<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use AppBundle\Form\PublicationType;
use BackendBundle\Entity\Publication;

class PublicationController extends Controller
{
    private $session;

    /**
     * PublicationController constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * Crea formulario con la clase PublicationType y lo renderiza en vista
     * Comprueba el formulario enviado y guarda los datos
     * Además pasa a la vista las publicaciones del timeline
     *
     * @param Request $request
     * @return $this
     */
    public function publicationsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $user_media_route = 'uploads/media/'.$user->getId().'_usermedia';

                // upload image
                $file = $form['image']->getData();
                if (!empty($file) && $file != null) {
                    $ext = $file->guessExtension(); // obtencion de extension

                    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                        $file_name = $user->getId().'_imgpublication_'.time().'.'.$ext;
                        $file->move($user_media_route.'/publications/images', $file_name);

                        $publication->setImage($file_name);
                    } else {
                        $publication->setImage(null);
                    }
                } else {
                    $publication->setImage(null);
                }

                // upload document
                $doc = $form['document']->getData();
                if (!empty($doc) && $doc != null) {
                    $ext = $doc->guessExtension(); // obtencion de extension

                    if ($ext == 'pdf') {
                        $file_name = $user->getId().'_docpublication_'.time().'.'.$ext;
                        $doc->move($user_media_route.'/publications/documents', $file_name);

                        $publication->setDocument($file_name);
                    } else {
                        $publication->setDocument(null);
                    }
                } else {
                    $publication->setDocument(null);
                }

                $publication->setUser($user);
                $publication->setCreatedAt(new \DateTime("now"));

                $em->persist($publication);
                $flush = $em->flush();

                if ($flush == null) {
                    $status = 'La publicación se ha creado correctamente !!';
                } else {
                    $status = 'Error al añadir la publicación !!';
                }

            } else {
                $status = 'La publicación no se ha creado, porque el formulario no es válido';
            }

            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute('home_publications');
        }

        $publications = $this->getPublications($request);

        return $this->render('AppBundle:Publication:home.html.twig', array(
            'form' => $form->createView(),
            'publications' => $publications
        ));
    }

    /**
     * Recupera mediante los datos de usuario logueado sus publicaciones
     * y las publicaciones de las personas que sigue
     * para ello se usa una subconsulta en dql
     * se devuelve un objeto con los resultados paginados
     *
     * @param $request
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getPublications($request) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $publication_repo = $em->getRepository('BackendBundle:Publication');
        $follow_repo = $em->getRepository('BackendBundle:Follow');

        /*
         * SELECT texto FROM sn_publication WHERE user = 4 OR
         * user IN (SELECT followed FROM sn_follow WHERE user = 4);
         */

        $following = $follow_repo->findBy(array('user' => $user));

        $following_array = array();
        foreach($following as $follow) {
            $following_array[] = $follow->getFollowed();
        }

        $query = $publication_repo->createQueryBuilder('p')
            ->where('p.user = (:user_id) OR p.user IN (:following)')
            ->setParameter('user_id', $user->getId())
            ->setParameter('following', $following_array)
            ->orderBy('p.id', 'DESC')
            ->getQuery();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), // parametro request de paginacion y en que num de pagina empieza
            5 //numero de registros por paginas
        );

        return $pagination;
    }


    /**
     * Borrado de Publicaciones via AJAX a traves de URL
     * Solo el autor de la publicacion puede borrar sus publicaciones
     *
     * @param null $id
     * @return Response
     */
    public function removePublicationAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $publication_repo = $em->getRepository('BackendBundle:Publication');

        $publication = $publication_repo->find($id);
        $user = $this->getUser();

        if($user->getId() == $publication->getUser()->getId()) {
            $em->remove($publication);
            $flush = $em->flush();

            if ($flush == null){
                $status = 'La publicación se ha borrado correctamente';
            } else {
                $status = 'La publicación no se ha borrado';
            }
        } else {
            $status = 'La publicación no se ha borrado';
        }

        return new Response($status);
    }

}
