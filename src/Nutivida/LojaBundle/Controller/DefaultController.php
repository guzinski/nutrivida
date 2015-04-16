<?php

namespace Nutivida\LojaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NutividaLojaBundle:Default:index.html.twig', array('name' => $name));
    }
}
