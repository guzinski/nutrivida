<?php

namespace Nutrivida\LojaBundle\Controller\Admin;

use Nutrivida\LojaBundle\Entity\Usuario;
use Nutrivida\LojaBundle\Form\UsuarioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * UsuarioController
 *
 * @author Luciano
 */
class UsuarioController extends Controller
{    
    /**
     * @Route("/usuario", name="_usuario")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/usuario/pagination", name="_usuario_pagination")
     * @return Response
     */
    public function paginationAction()
    {
        $usuarios = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Usuario")->findAll();
        $dados = array();
        foreach ($usuarios as $usuario) {
            $linha = array();
            
            $linha[] = "<a href=\"".$this->generateUrl("_usuario_form", array("id"=>$usuario->getId())) ."\">". $usuario->getNome() ."</a>";
            $linha[] = $usuario->getEmail();
            $linha[] = $usuario->getAtivo() ? "Sim" : "Não";
            $linha[] = "<a href=\"javascript:excluirUsuario(".$usuario->getId() .");\"><i class=\"glyphicon glyphicon-trash\"></a>";
            $dados[] = $linha;
        }
        $return['recordsTotal'] = count($usuarios);
        $return['recordsFiltered'] = count($usuarios);
        $return['data'] = $dados;
        return new Response(json_encode($return));
    }

    
    /**
     * 
     * @Route("/usuario/editar/{id}", name="_usuario_form")
     * @Template()
     */
    public function formAction(Request $request, $id = 0) 
    {
        $em = $this->getDoctrine()->getManager();
        
        if ($id>0) {
            $usuario = $em->find("NutrividaLojaBundle:Usuario", $id);
        } else {
            $usuario = new Usuario();
        }
        
        $form = $this->createForm(new UsuarioType(), $usuario);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($usuario);
            $em->flush();
            return $this->redirectToRoute("_usuario");
        }
        
        return array("usuario"=>$usuario, "form"=>$form->createView());
    }

    /**
     * @Route("/usuario/excluir", name="_usuario_excluir")
     */
    public function excluiUsuarioAction(Request $resquest) 
    {
        $respone = array();
        $id = $resquest->request->getInt("id", null);
        if (null != $id) {
            $em = $this->getDoctrine()->getManager();
            $usuario = $em->find("NutrividaLojaBundle:Usuario", $id);
            $em->remove($usuario);
            $em->flush();
            $respone['ok'] = 1;
        } else {
            $respone['ok'] = 0;
            $respone['error'] = "Erro ao exclui usuário";
        }
        return new Response(json_encode($respone));
    }

    
}
