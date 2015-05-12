<?php

namespace Nutrivida\LojaBundle\Controller\Loja;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of ContatoController
 *
 * @author Luciano
 */
class ContatoController extends Controller
{
    /**
     * @Route("/nutrivida/contato", name="_loja_contato")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
