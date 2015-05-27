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
     * @Route("/alterar/quantidade/{idProduto}/{quantidade}", name="_loja_carrinho_alterar_quantidade")
     * @param type $idProduto
     * @param type $quantidade
     * @return array
     */
    public function alterarQuantidadeAction($idProduto = null, $quantidade = null)
    {
        if ($idProduto && $quantidade) {
            $session = $this->get("session");
            $carrinho = $session->get('carrinho', array());
            if (array_key_exists($idProduto, $carrinho)) {
                $carrinho[$idProduto] = $quantidade;
            }
            $session->set('carrinho', $carrinho);
        }
        return new Response();
    }

    /**
     * @Route("/finalizar", name="_loja_carrinho_finalizar")
     */
    public function finalizarAction()
    {
        $user = $this->getUser();
        $result = array();
        $result["ok"] = 0;
        $result["user"] = 0;
        if ($user) {
            $result["user"] = 1;
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository("NutrividaLojaBundle:Produto");
            $session = $this->get("session");
            $carrinho = $session->get('carrinho', array());
            $produtos = $rep->findById(array_keys($carrinho));
            $pedido = new \Nutrivida\LojaBundle\Entity\Pedido();
            $pedido->setCliente($em->find("NutrividaLojaBundle:Cliente", $user->getId()));            
            foreach ($produtos as $produto) {
                $pedido->getProdutos()->add($produto);
            }
            $em->persist($pedido);
            $em->flush();
            $session->set('carrinho', array());
            $result["ok"] = 1;
        }
        return new Response(json_encode($result));
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
