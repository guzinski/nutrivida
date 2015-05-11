<?php

namespace Nutrivida\LojaBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;



/**
 * Description of ClienteController
 *
 * @author Luciano
 */
class ClienteController extends Controller
{
    
    /**
     * @Route("/cliente", name="_cliente")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/cliente/pagination", name="_cliente_pagination")
     * @return Response
     */
    public function paginationAction()
    {
        $clientes = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Cliente")->findAll();
        $dados = array();
        foreach ($clientes as $cliente) {
            $linha = array();
            $linha[] = $cliente->getNome();
            $linha[] = $cliente->getEmail();
            $dados[] = $linha;
        }
        $return['recordsTotal'] = count($clientes);
        $return['recordsFiltered'] = count($clientes);
        $return['data'] = $dados;
        return new Response(json_encode($return));
    }

}
