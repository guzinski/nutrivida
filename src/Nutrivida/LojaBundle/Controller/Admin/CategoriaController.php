<?php

namespace Nutrivida\LojaBundle\Controller\Admin;

use Nutrivida\LojaBundle\Entity\Categoria;
use Nutrivida\LojaBundle\Form\CategoriaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of CategoriaController
 *
 * @author Luciano
 */
class CategoriaController extends Controller
{
    
    /**
     * @Route("/categoria", name="_categoria")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/categoria/pagination", name="_categoria_pagination")
     * @return Response
     */
    public function paginationAction()
    {
        $categorias = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Categoria")->findAll();
        $dados = array();
        foreach ($categorias as $categoria) {
            $linha = array();
            $linha[] = "<a href=\"".$this->generateUrl("_categoria_form", array("id"=>$categoria->getId())) ."\">". $categoria->getNome() ."</a>";
            $linha[] = "<a href=\"javascript:excluirCategoria(".$categoria->getId() .");\"><i class=\"glyphicon glyphicon-trash\"></a>";
            $dados[] = $linha;
        }
        $return['recordsTotal'] = count($categorias);
        $return['recordsFiltered'] = count($categorias);
        $return['data'] = $dados;
        return new Response(json_encode($return));
    }

    
    /**
     * @Route("/categoria/editar/{id}", name="_categoria_form")
     * @Template()
     * 
     * @param type $id
     * @param Request $request
     * @return type
     */
    public function formAction(Request $request, $id = null)
    {
        $em = $this->getDoctrine()->getManager();
        if ($id == null) {
            $categoria = new Categoria();
        } else {
            $categoria = $em->find("NutrividaLojaBundle:Categoria", $id);
        }
        
        $form = $this->createForm(new CategoriaType(), $categoria);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em->persist($categoria);
            $em->flush();
            return $this->redirectToRoute("_categoria");
        }
        
        return array("categoria"=>$categoria, "form"=>$form->createView());
    }
    
}
