<?php

namespace Nutrivida\LojaBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Description of NewsController
 *
 * @author Luciano
 */
class NewsController extends Controller
{
    /**
     * @Route("/news", name="_news")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/news/pagination", name="_news_pagination")
     * @return Response
     */
    public function paginationAction()
    {
        $news = $this->getDoctrine()->getRepository("NutrividaLojaBundle:News")->findAll();
        $dados = array();
        foreach ($news as $new) {
            $linha = array();
            $linha[] = $new->getEmail();
            $dados[] = $linha;
        }
        $return['recordsTotal'] = count($news);
        $return['recordsFiltered'] = count($news);
        $return['data'] = $dados;
        return new Response(json_encode($return));
    }
    
    /**
     * @Route("/news/exportar", name="_news_exportar")
     * @return StreamedResponse
     */
    public function exportarAction()
    {
        
        $response = new StreamedResponse();
        $response->setCallback(function(){

            $handle = fopen('php://output', 'w+');

            // Add a row with the names of the columns for the CSV file
            fputcsv($handle, array('E-mail'),';');
            // Query data from database
            $news = $this->getDoctrine()->getRepository("NutrividaLojaBundle:News")->findAll();
            //$results = $this->connection->query( "Replace this with your query" );
            // Add the data queried from database
            foreach ($news as $new) {
                fputcsv($handle,array($new->getEmail()),';');
            } 

            fclose($handle);
        });
 
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition','attachment; filename="export.csv"');
 
        return $response;
    }
}
