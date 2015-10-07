<?php

namespace Nutrivida\LojaBundle\Controller\Loja;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    
    /**
     * @Route("/", name="_loja_index")
     * @Template()
     */
    public function indexAction()
    {
        $banners = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Banner")->findBy(array("ativo"=>"1"));
        $produtos = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Produto")->getProdutosDestaques();
        $descontos = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Produto")->getProdutosComDesconto();
        
        return array("banners"=>$banners, "produtos"=>$produtos, "descontos"=>$descontos);
    }
    
    /**
     * 
     * @return type
     */
    public function renderMenuAction()
    {
        $categorias = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Categoria")->findAll();
        
        return $this->render(
            'NutrividaLojaBundle::Loja\\menu.html.twig',
            array('categorias' => $categorias)
        );
    }
}
