<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use BackendBundle\Entity\User;
use BackendBundle\Entity\PrivateMessage;
use AppBundle\Form\PrivateMessageType;


class PrivateMessageController extends Controller
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
     * Renderiza en vista el formulario para enviar Mensajes Privados para ello
     * usa clase PrivateMessageType para definir los campos del formulario
     * Procesa el formulario y guarda los datos
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function sendPrivateMessageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $private_message = new PrivateMessage();
        $form = $this->createForm(PrivateMessageType::class, $private_message, array(
            'empty_data' => $user
        ));

        // data binding form
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {

                $user_media_route = 'uploads/media/'.$user->getId().'_usermedia';

                // upload image
                $file = $form['image']->getData();
                if (!empty($file) && $file != null) {
                    $ext = $file->guessExtension(); // obtencion de extension

                    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                        $file_name = $user->getId().'_imgpmessage_'.time().'.'.$ext;
                        $file->move($user_media_route.'/pmessages/images', $file_name);

                        $private_message->setImage($file_name);
                    } else {
                        $private_message->setImage(null);
                    }
                } else {
                    $private_message->setImage(null);
                }

                // upload file
                $doc = $form['file']->getData();
                if (!empty($doc) && $doc != null) {
                    $ext = $doc->guessExtension(); // obtencion de extension

                    if ($ext == 'pdf') {
                        $file_name = $user->getId().'_docpmessage_'.time().'.'.$ext;
                        $doc->move($user_media_route.'/pmessages/documents', $file_name);

                        $private_message->setFile($file_name);
                    } else {
                        $private_message->setFile(null);
                    }
                } else {
                    $private_message->setFile(null);
                }

                $private_message->setEmitter($user);
                $private_message->setCreatedAt(new \DateTime("now"));
                $private_message->setReaded(0);

                $em->persist($private_message);
                $flush = $em->flush();

                if ($flush == null) {
                    $status = 'El mensaje privado se ha enviado correctamente';
                } else {
                    $status = 'Error al enviar el mensaje privado';
                }

            } else {
                $status = 'El mensaje privado no se ha enviado';
            }

            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute('private_message_send');
        }

        return $this->render('AppBundle:PrivateMessage:form_private_message.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
