<?php

namespace Nutrivida\LojaBundle\Controller\Admin;

use Nutrivida\LojaBundle\Entity\Empresa;
use Nutrivida\LojaBundle\Entity\EmpresaImagem;
use Nutrivida\LojaBundle\Form\EmpresaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Description of EmpresaController
 *
 * @author Luciano
 */
class EmpresaController extends Controller
{
    
    /**
     * 
     * @Route("/empresa", name="_empresa")
     * @Template()
     */
    public function formAction(Request $request) 
    {
        $mm = $this->container->get('sonata.media.manager.media');
        $em = $this->getDoctrine()->getManager();
        $empresa = $em->getRepository("NutrividaLojaBundle:Empresa")->findOneBy(array());
        
        if ($empresa == null) {
            $empresa = new Empresa();
        }
        
        $form = $this->createForm(new EmpresaType(), $empresa);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $excluidas = $request->get("excluidas", array());
            $imagens = $request->get("imagens", array());
            foreach ($excluidas as $media) {
                $objImage = $em->find("NutrividaLojaBundle:EmpresaImagem", $media);
                $empresa->getImagens()->removeElement($objImage);
                $em->remove($objImage);
            }
            foreach ($imagens as $imagem) {
                $empresa->getImagens()->add(new EmpresaImagem($mm->find($imagem), $empresa));
            }
            $em->persist($empresa);
            $em->flush();
            return $this->redirectToRoute("_empresa");
        }
        
        return array("empresa"=>$empresa, "form"=>$form->createView());
    }

}
