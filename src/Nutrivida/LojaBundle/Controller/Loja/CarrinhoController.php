<?php

namespace Nutrivida\LojaBundle\Controller\Loja;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of CarrinhoController
 * @Route("/carrinho")
 * @author Luciano
 */
class CarrinhoController extends Controller
{
    
    /**
     * @Route("/", name="_loja_carrinho")
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        $rep = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Produto");
        $session = $this->get("session");
        $carrinho = $session->get('carrinho', array());
        $produtos = $rep->findById(array_keys($carrinho));
        return array("carrinho"=>$carrinho, "produtos"=>$produtos);
    }
    
    /**
     * @Route("/adicionar/{idProduto}", name="_loja_carrinho_adicionar")
     * @param type $idProduto
     * @return array
     */
    public function adicionarAction($idProduto = null)
    {
        $rep = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Produto");
        $session = $this->get("session");
        $carrinho = $session->get('carrinho', array());
        if ($rep->findOneById($idProduto) && $idProduto) {
            if (array_key_exists($idProduto, $carrinho)) {
                $carrinho[$idProduto]++;
            } else {
                $carrinho[$idProduto] = 1;
            }
            $msg = "Produto adicionado com sucesso";
        } else {
            $msg = "Erro ao adicionar o produto";
        }
        $session->set('carrinho', $carrinho);
        return new Response($msg);
    }
    
    /**
     * @Route("/remover/{idProduto}", name="_loja_carrinho_remover")
     * @param type $idProduto
     */
    public function removerAction($idProduto = null)
    {
        if ($idProduto) {
            $session = $this->get("session");
            $carrinho = $session->get('carrinho', array());
            if (array_key_exists($idProduto, $carrinho)) {
                unset($carrinho[$idProduto]);
            }
            $session->set('carrinho', $carrinho);
        }
        return new Response();
    }
    
    /**
     * 
     * @return type
     */
    public function carrinhoTopAction()
    {
        $rep = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Produto");
        $session = $this->get("session");
        $carrinho = $session->get('carrinho', array());
        $produtos = $rep->findById(array_keys($carrinho));
        $valor = 0;
        foreach ($produtos as $produto) {
            $valor += $produto->getValor()*$carrinho[$produto->getId()];
        }
        
        $totalQtd = array_sum($carrinho);
        return $this->render(
            'NutrividaLojaBundle::Loja\\carrinhoTop.html.twig',
            array('totalQtd' => $totalQtd, "valorTotal" => $valor)
        );
    }

    
    
}
