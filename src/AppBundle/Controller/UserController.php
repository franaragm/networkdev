<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        return $this->render('AppBundle:User:login.html.twig', array(
            "titulo" => "Login"
        ));
    }
}
