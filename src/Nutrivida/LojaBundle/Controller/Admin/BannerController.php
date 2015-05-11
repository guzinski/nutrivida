<?php

namespace Nutrivida\LojaBundle\Controller\Admin;

use Nutrivida\LojaBundle\Entity\Banner;
use Nutrivida\LojaBundle\Form\BannerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of BannerController
 *
 * @author Luciano
 */
class BannerController extends Controller
{
    
    /**
     * @Route("/banner", name="_banner")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/banner/pagination", name="_banner_pagination")
     * @return Response
     */
    public function paginationAction()
    {
        $banners = $this->getDoctrine()->getRepository("NutrividaLojaBundle:Banner")->findAll();
        $dados = array();
        foreach ($banners as $banner) {
            $linha = array();
            
            $linha[] = "<a href=\"".$this->generateUrl("_banner_form", array("id"=>$banner->getId())) ."\">". $banner->getNome() ."</a>";
            $linha[] = $this->renderView("NutrividaLojaBundle::Admin/Banner/thumb.html.twig", array("media"=>$banner->getMedia()));
            $linha[] = $banner->getAtivo() ? "Sim" : "Não";
            $linha[] = "<a href=\"javascript:excluirBanner(".$banner->getId() .");\"><i class=\"glyphicon glyphicon-trash\"></a>";
            $dados[] = $linha;
        }
        $return['recordsTotal'] = count($banners);
        $return['recordsFiltered'] = count($banners);
        $return['data'] = $dados;
        return new Response(json_encode($return));
    }
    
    /**
     * 
     * @Route("/banner/editar/{id}", name="_banner_form")
     * @Template()
     */
    public function formAction(Request $request, $id = 0) 
    {
        $mm = $this->container->get('sonata.media.manager.media');
        $em = $this->getDoctrine()->getManager();
        
        if ($id>0) {
            $banner = $em->find("NutrividaLojaBundle:Banner", $id);
        } else {
            $banner = new Banner();
        }
        
        $form = $this->createForm(new BannerType(), $banner, array('em'=>$this->container->get('sonata.media.manager.media')));
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $excluidas = $request->get("excluidas", array());
            foreach ($excluidas as $media) {
                $mm->delete($mm->find($media), true);
            }
            $em->persist($banner);
            $em->flush();
            return $this->redirectToRoute("_banner");
        }
        
        return array("banner"=>$banner, "form"=>$form->createView());
    }
    
    /**
     * @Route("/banner/excluir", name="_banner_excluir")
     */
    public function excluiBannerAction(Request $resquest) 
    {
        $id = $resquest->request->getInt("id", null);
        if (null != $id) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($em->find("NutrividaLojaBundle:Banner", $id));
            $em->flush();
        }
        return new Response();
    }
    
    
}
