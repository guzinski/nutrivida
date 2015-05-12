<?php

namespace Nutrivida\LojaBundle\Controller\Loja;

use Nutrivida\LojaBundle\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of NewsController
 *
 * @author Luciano
 */
class NewsController extends Controller
{
    /**
     * @Route("/news/cadastro", name="_loja_news")
     */
    public function indexAction(Request $request)
    {
        
        $email = $request->get("email");
        
        if (null == $email) {
            $mensagem = "Preencha o seu E-mail";
        } else {
            $news = $this->getDoctrine()->getRepository("NutrividaLojaBundle:News")->findOneBy(array("email"=>$email));
            if (null == $news) {
                $news = new News();
                $news->setEmail($email);
                $this->getDoctrine()->getManager()->persist($news);
                $this->getDoctrine()->getManager()->flush();
                $mensagem = "Seu E-mail foi inserido";
            } else {
                $mensagem = "Seu E-mail já está cadastrado";
            }
        }
        
        return new Response($mensagem);
    }
    
    
}
