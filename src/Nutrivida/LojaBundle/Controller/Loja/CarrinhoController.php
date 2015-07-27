<?php

namespace Nutrivida\LojaBundle\Controller\Loja;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


/**
 * Description of CarrinhoController
 * @Route("/carrinho")
 * @author Luciano
 */
class CarrinhoController extends Controller
{
    
    const sedex = "40010";
    const pac = "41106";

    /**
     * @Route("/", name="_loja_carrinho")
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        return array(
                    "carrinho"=>$this->getCarrinho(), 
                    "produtos"=>$this->getProdutosCarrinho()
                );
    }
    
    /**
     * @Route("/adicionar/{idProduto}", name="_loja_carrinho_adicionar")
     * @param type $idProduto
     * @return array
     */
    public function adicionarAction($idProduto = null)
    {
        $rep = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Produto");
        $carrinho = $this->getCarrinho();
        if ($rep->findOneById($idProduto) && $idProduto) {
            if ($this->verficicaSeProdutoExisteNoCarrinho($idProduto, $carrinho)) {
                $carrinho[$idProduto]++;
            } else {
                $carrinho[$idProduto] = 1;
            }
            $msg = "Produto adicionado com sucesso";
        } else {
            $msg = "Erro ao adicionar o produto";
        }
        $this->setCarrinho($carrinho);
        return new Response($msg);
    }
    
    /**
     * @Route("/remover/{idProduto}", name="_loja_carrinho_remover")
     * @param type $idProduto
     */
    public function removerAction($idProduto = null)
    {
        if ($idProduto) {
            $carrinho = $this->getCarrinho();
            if ($this->verficicaSeProdutoExisteNoCarrinho($idProduto, $carrinho)) {
                unset($carrinho[$idProduto]);
            }
            $this->setCarrinho($carrinho);
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
            $carrinho = $this->getCarrinho();
            if ($this->verficicaSeProdutoExisteNoCarrinho($idProduto, $carrinho)) {
                $carrinho[$idProduto] = $quantidade;
            }
            $this->setCarrinho($carrinho);
        }
        return new Response();
    }

    /**
     * @Route("/finalizar", name="_loja_carrinho_finalizar")
     */
    public function finalizarAction(Request $request)
    {
        $user = $this->getUser();
        $result = array();
        $result["ok"] = 0;
        $result["user"] = 0;
        if ($user) {
            $arrayFrete = explode("|", $request->get("frete"));
            $tipoFrete = $arrayFrete[0];
            $resultFrete = $this->calculaPreçoFrete($request->get("cep"), $tipoFrete);
            $valorFrete = str_replace(",", ".", str_replace(".", "", $resultFrete->CalcPrecoPrazoResult->Servicos->cServico->Valor));
            $result["user"] = 1;
            $em = $this->getDoctrine()->getManager();
            $produtos = $this->getProdutosCarrinho();
            $pedido = new \Nutrivida\LojaBundle\Entity\Pedido();
            $pedido->setCliente($em->find("NutrividaLojaBundle:Cliente", $user->getId()));
            $pedido->setTipoFrete($tipoFrete);
            $pedido->setValorFrete($valorFrete);
            foreach ($produtos as $produto) {
                $pedido->getProdutos()->add($produto);
            }
            $em->persist($pedido);
            $em->flush();
            $this->limpaCarrinho();
            $result["ok"] = 1;
        }
        return new Response(json_encode($result));
    }
    
    /**
     * @Route("/calculaFrete/{cep}", name="_loja_carrinho_calcula_frete")
     */
    public function calculaFreteAction($cep = null) 
    {        
        $resultPac = $this->calculaPreçoFrete($cep, self::pac);
        $parametros['nCdServico'] = self::sedex;
        $resultSedex = $this->calculaPreçoFrete($cep, self::sedex);
        
        return new Response(json_encode(array(0=>$resultPac, 1=>$resultSedex)));
    }
    
    /**
     * Calcula o frete do carrinho para um ep específico
     * 
     * @param type $cep
     * @param type $tipo
     * @return type
     */
    private function calculaPreçoFrete($cep, $tipo) 
    {
        $pesoTotal          = 0;
        $comprimentoTotal   = 0;
        $alturaTotal        = 0;
        $larguraTotal       = 0;

        $produtos   = $this->getProdutosCarrinho();

        foreach ($produtos as $produto) {
            $pesoTotal += $produto->getPeso();
            $comprimentoTotal += $produto->getComprimento();
            $alturaTotal += $produto->getAltura();
            $larguraTotal += $produto->getLargura();
        }
        
        if ($comprimentoTotal<16) {
            $comprimentoTotal = 16;
        } elseif ($comprimentoTotal>105) {
            $comprimentoTotal = 105;
        }
        
        if ($larguraTotal<11) {
            $larguraTotal = 11;
        } elseif ($larguraTotal>105) {
            $larguraTotal = 105;
        }
        
        if ($alturaTotal<2) {
            $alturaTotal = 2;
        } elseif ($alturaTotal>105) {
            $alturaTotal = 105;
        }
        
        $soap = new \SoapClient("http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx?wsdl");
        $parametros = array(
            "nCdEmpresa" => "",
            "nCdEmpresa" => "",
            "nCdServico" => $tipo,
            "sCepOrigem" => "91120640",
            "sCepDestino" => (string) preg_replace("/[^0-9]/", "", $cep),
            "nVlPeso" => (string) $pesoTotal,
            "nCdFormato" => "1",
            "nVlComprimento" => $comprimentoTotal,
            "nVlAltura" => $alturaTotal,
            "nVlLargura" => $larguraTotal,
            "nVlDiametro" => 0,
            "sCdMaoPropria" => "N",
            "nVlValorDeclarado" => 0,
            "sCdAvisoRecebimento" => "N",
        );

        return $soap->__soapCall("CalcPrecoPrazo", array($parametros));;
    }


    /**
     * Retorno o carrinho da sessão
     * 
     * @return type
     */
    private function getCarrinho()
    {
        $session = $this->get("session");
        return $session->get('carrinho', array());
    }
    
    /**
     * Seta o carrinho novo na sessão
     * 
     * @param type $carrinho
     * @return type
     */
    private function setCarrinho($carrinho)
    {
        $session = $this->get("session");
        return $session->set('carrinho', $carrinho);
    }

    /**
     * Retorna os produtos do carrinho
     * 
     * @return type
     */
    private function getProdutosCarrinho() 
    {
        $rep        = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Produto");
        $session    = $this->get("session");
        $carrinho   = $session->get('carrinho', array());
        return $rep->findById(array_keys($carrinho));
    }
    
    /**
     * Limpa o carrinho
     */
    private function limpaCarrinho()
    {
        $session    = $this->get("session");
        $session->set('carrinho', array());
    }
    
    /**
     * 
     * @param type $idProduto
     * @param type $carrinho
     * @return type
     */
    private function verficicaSeProdutoExisteNoCarrinho($idProduto, $carrinho)
    {
        return array_key_exists($idProduto, $carrinho);
    }

    /**
     * 
     * @return type
     */
    public function carrinhoTopAction()
    {
        $carrinho = $this->getCarrinho();
        $produtos = $this->getProdutosCarrinho();
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
