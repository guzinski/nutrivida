<?php

namespace Nutrivida\LojaBundle\Controller\Admin;

use Nutrivida\LojaBundle\Entity\Produto;
use Nutrivida\LojaBundle\Entity\ProdutoImagem;
use Nutrivida\LojaBundle\Form\ProdutoTyoe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of ProdutoController
 *
 * @author Luciano
 */
class ProdutoController extends Controller
{
    
    
    /**
     * @Route("/produto", name="_produto")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/produto/pagination", name="_produto_pagination")
     * @return Response
     */
    public function paginationAction()
    {
        $produtos = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Produto")->findAll();
        $dados = array();
        foreach ($produtos as $produto) {
            $linha = array();
            
            $linha[] = "<a href=\"".$this->generateUrl("_produto_form", array("id"=>$produto->getId())) ."\">". $produto->getNome() ."</a>";
            $linha[] = $produto->getCategoria()->getNome();
            $linha[] = $produto->getAtivo() ? "Sim" : "Não";
            $linha[] = "<a href=\"javascript:excluirProduto(".$produto->getId() .");\"><i class=\"glyphicon glyphicon-trash\"></a>";
            $dados[] = $linha;
        }
        $return['recordsTotal'] = count($produtos);
        $return['recordsFiltered'] = count($produtos);
        $return['data'] = $dados;
        return new Response(json_encode($return));
    }

    
    /**
     * 
     * @Route("/produto/editar/{id}", name="_produto_form")
     * @Template()
     */
    public function formAction(Request $request, $id = 0) 
    {
        $mm = $this->container->get('sonata.media.manager.media');
        $em = $this->getDoctrine()->getManager();
        
        if ($id>0) {
            $produto = $em->find("NutrividaLojaBundle:Produto", $id);
        } else {
            $produto = new Produto();
        }
        
        $form = $this->createForm(new ProdutoTyoe(), $produto);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $excluidas = $request->get("excluidas", array());
            $imagens = $request->get("imagens", array());
            foreach ($excluidas as $media) {
                $objImage = $em->find("NutrividaLojaBundle:ProdutoImagem", $media);
                $produto->getImagens()->removeElement($objImage);
                
                $em->remove($objImage);
            }
            foreach ($imagens as $imagem) {
                $produto->getImagens()->add(new ProdutoImagem($mm->find($imagem), $produto));
            }
            $em->persist($produto);
            $em->flush();
            return $this->redirectToRoute("_produto");
        }
        
        return array("produto"=>$produto, "form"=>$form->createView());
    }

    /**
     * @Route("/produto/excluir", name="_produto_excluir")
     */
    public function excluiProdutoAction(Request $resquest) 
    {
        $respone = array();
        $id = $resquest->request->getInt("id", null);
        if (null != $id) {
            $em = $this->getDoctrine()->getManager();
            $produto = $em->find("NutrividaLojaBundle:Produto", $id);
            $em->remove();
            $em->flush();
            $respone['ok'] = 1;
        } else {
            $respone['ok'] = 0;
            $respone['error'] = "Erro ao exclui produto";
        }
        return new Response(json_encode($respone));
    }

    
}
