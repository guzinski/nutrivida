<?php

namespace Nutrivida\LojaBundle\Controller\Admin;

use Application\Sonata\MediaBundle\Entity\Media;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of UploadController
 *
 * @author Luciano
 */
class UploadController extends Controller
{
     
    /**
     * @Route("/upload", name="_upload")
     * 
     * @param Request $request
     * @return Response
     */
    public function uploadAction(Request $request) 
    {
        $mediaManager = $this->container->get('sonata.media.manager.media');
        // Getting sonata media object and saving media
        
//        $files = $request->files->get('file');
//        if (is_array($files)) {
//            foreach ($files as $file) {
//                $media = new Media();
//                $media->setBinaryContent($file);
//                $media->setContext('default');
//                $media->setProviderName('sonata.media.provider.image');
//                $mediaManager->save($media);
//            }
//        } else {
//            $media = new Media();
//            $media->setBinaryContent($request->files->get('file'));
//            $media->setContext('default');
//            $media->setProviderName('sonata.media.provider.image');
//            $mediaManager->save($media);
//        }
        $media = new Media();
        $media->setBinaryContent($request->files->get('file'));
        $media->setContext('default');
        $media->setProviderName('sonata.media.provider.image');
        $mediaManager->save($media);
        return new Response($media->getId());
    }
    
    /**
     * @Route("/upload/delete", name="_upload_delete")
     * 
     * @param Request $request
     * @return Response
     */
    public function deleteAction(Request $request)
    {
        $mediaManager = $this->container->get('sonata.media.manager.media');
        $mediaManager->delete($mediaManager->find($request->request->getInt("id")), true);
        return new Response("");
    }
    
    
}
