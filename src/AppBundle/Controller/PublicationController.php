<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     *
     * @param Request $request
     * @return $this
     */
    public function indexAction(Request $request)
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

        return $this->render('AppBundle:Publication:home.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
