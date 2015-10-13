<?php

namespace Nutrivida\LojaBundle\Controller\Loja;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
;

/**
 * Description of ProdutoController
 *
 * @author Luciano
 */
class ProdutoController extends Controller
{
    
    /**
     * @Route("/{slugCategoria}/{slug}", name="_loja_produto")
     * @Template()
     */
    public function indexAction($slugCategoria, $slug)
    {
        $produto    = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Produto")->findOneBy(array("slug"=>$slug));
        $categoria  = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Categoria")->findOneBy(array('slug'=>$slugCategoria));
        if (null == $produto) {
            $this->createNotFoundException("Produto não encontrado");
        }
        return ['produto'=>$produto, 'categoria'=> $categoria];
    }
}
