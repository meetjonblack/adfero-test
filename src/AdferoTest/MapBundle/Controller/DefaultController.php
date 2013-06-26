<?php

namespace AdferoTest\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdferoTestMapBundle:Default:index.html.twig');
    }
}
