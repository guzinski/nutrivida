<?php

namespace Nutrivida\LojaBundle\Controller\Loja;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of EmpresaController
 *
 * @author Luciano
 */
class EmpresaController extends Controller
{
    
    /**
     * @Route("/nutrivida/sobre", name="_loja_empresa")
     * @Template()
     */
    public function indexAction()
    {
        $empresa = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Empresa")->findOneBy(array());
        return array("empresa"=>$empresa);
    }
    
    /**
     * @Route("/nutrivida/pedidos", name="_loja_pedidos")
     * @Template()
     */
    public function pedidosAction()
    {
        return array();
    }
    
    /**
     * @Route("/nutrivida/privacidade", name="_loja_privacidade")
     * @Template()
     */
    public function privacidadeAction()
    {
        return array();
    }
    
    
}
