<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PublicationController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Publication:home.html.twig');
    }
}
