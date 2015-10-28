<?php

namespace Nutrivida\LojaBundle\Controller\Loja;

use Nutrivida\LojaBundle\Entity\Cliente;
use Nutrivida\LojaBundle\Form\ClienteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Description of ClienteController
 * @Route("/cliente")
 * @author Luciano
 */
class ClienteController extends Controller 
{
    
    /**
     * @Route("/area", name="_loja_cliente")
     * @Template()
     * @return array
     */
    public function indexAction() 
    {
        return array();
    }
    
    /**
     * @Route("/pedido/finalizado", name="_loja_cliente_pedido_finalizado")
     * @Template()
     * @return array
     */
    public function pedidoFinalizadoAction() 
    {
        return array();
    }
    
    /**
     * 
     * @Route("/cadastro", name="_loja_cadastro_cliente")
     * @Template()
     */
    public function cadastroAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if ($user) {
            $cliente = $em->find("NutrividaLojaBundle:Cliente", $user->getId());
        } else {
            $cliente = new Cliente();
        }
        
        $form = $this->createForm(new ClienteType(),  $cliente);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($cliente);
            $em->flush();
            
            if (!$user) {
                $token = new UsernamePasswordToken($cliente, null, 'loja', $cliente->getRoles());
                $this->get('security.context')->setToken($token);
                $this->get('session')->set('_security_loja', serialize($token));
            }

            return $this->redirectToRoute("_loja_carrinho");
        }
        
        return array("cliente"=>$cliente, "form"=>$form->createView());

    }
    
    /**
     * @Route("/login", name="_login_cliente")
     * @Template()
     * @return array
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        $errorMsg = "";
        $form = $this->createForm(new ClienteType(),  new Cliente());

        $form->handleRequest($request);

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->set(SecurityContext::AUTHENTICATION_ERROR, "");
        }
        
        if (is_object($error)) {
            $errorMsg = $this->get("translator")->trans($error->getMessage());
        }

        return [
            'last_username' =>  $session->get(SecurityContext::LAST_USERNAME),
            'error'         =>  $errorMsg,
            'form'          =>  $form->createView()
        ];
    }
    
    
    
    
    
}
