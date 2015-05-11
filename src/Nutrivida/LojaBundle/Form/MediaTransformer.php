<?php

namespace Nutrivida\LojaBundle\Form;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Description of MediaTransformer
 *
 * @author Luciano
 */
class MediaTransformer implements DataTransformerInterface 
{
    
    private $mediaManager;
    
    public function __construct($mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }
    
    public function reverseTransform($id)
    {
        if (!is_numeric($id)) {
            return null;
        }

        $media = $this->mediaManager->find($id);
        if (empty($media)) {
            return null;
        }

        return $media;
    }

    public function transform($media)
    {
        if (null == $media) {
            return "";
        }
        $media->getId();
    }

    
}
