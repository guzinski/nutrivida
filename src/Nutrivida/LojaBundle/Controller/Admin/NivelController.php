<?php

namespace Nutrivida\LojaBundle\Controller\Admin;

use Nutrivida\LojaBundle\Form\NivelType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Description of NivelController
 *
 * @author Luciano
 */
class NivelController extends Controller
{
    
    /**
     * @Route("/nivel/{id}", name="_nivel")
     * @Template()
     */
    public function indexAction(Request $request, $id = null) 
    {
        $response = array();
        $em = $this->getDoctrine()->getManager();
        $response['niveis'] = $em->getRepository("NutrividaLojaBundle:Nivel")->findAll();
        $response['id'] = $id;
        
        if ($id>0) {
            $nivel = $em->find("NutrividaLojaBundle:Nivel", $id);
            $form = $this->createForm(new NivelType(), $nivel);
            $form->handleRequest($request);
            $response['form'] = $form->createView();
            if ($form->isValid()) {
                $em->persist($nivel);
                $em->flush();
                return $this->redirectToRoute("_nivel", array("id"=>$id));
            }
        } else {
            $response['form'] = null;
        }

        return $response;
    }
    
    
    
}
