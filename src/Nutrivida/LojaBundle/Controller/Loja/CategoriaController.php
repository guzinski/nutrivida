<?php

namespace Nutrivida\LojaBundle\Controller\Loja;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of CategoriaController
 *
 * @author Luciano
 */
class CategoriaController extends Controller
{
    /**
     * 
     * @param type $id
     * @param type $page
     * @param type $order
     * @return type
     * @Route("/{slug}/{page}/{order}", name="_loja_categoria", requirements={"page": "\d+"})
     * @Template()
     */
    public function indexAction($slug, $page = 1, $order = null)
    {
        $perPage = 12;
        $repProduto = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Produto");
        $categoria  = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Categoria")->findOneBy(array('slug'=>$slug));
        $categorias = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Categoria")->findAll();
        $destaques  = $repProduto->getProdutoAtivos($categoria->getId(), true);
        $produtos   = $repProduto->getProdutoAtivos($categoria->getId(), null, $order, $perPage, ($page-1)*$perPage);
        $total      = $repProduto->countProdutoAtivos($categoria->getId(), null);
        $totalPages = ceil($total/$perPage);
        return array(
            "categoria" =>  $categoria, 
            "categorias"=>  $categorias, 
            "destaques" =>  $destaques,
            "produtos"  =>  $produtos,
            "total"     =>  $total,
            "totalPages"=>  $totalPages,
            "page"      =>  $page,
            "order"     =>  $order,
        );
    }
    
    
}
