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
        $user = $this->getUser();
        var_dump($user);
        $banners = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Banner")->findBy(array("ativo"=>"1"));
        $categorias = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Categoria")->getProdutosDestaques();
        
        
        return array("banners"=>$banners, "categorias"=>$categorias);
    }
    
    /**
     * 
     * @return type
     */
    public function rederMenuAction()
    {
        $categorias = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Categoria")->findAll();
        
        return $this->render(
            'NutrividaLojaBundle::Loja\\menu.html.twig',
            array('categorias' => $categorias)
        );
    }
}
