<?php

namespace Nutrivida\LojaBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;


/**
 * Banner
 *
 * @ORM\Table(name="banner")
 * @ORM\Entity
 */
class Banner
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=150, nullable=false)
     */
    private $nome;

    /**
     * @var float
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $ativo = 0;
    
    /**
     * @var Media
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"}, fetch="LAZY")
     */
    private $media;
    
    
    function getId()
    {
        return $this->id;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getAtivo()
    {
        return $this->ativo;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    
    function getMedia()
    {
        return $this->media;
    }

    function setMedia(Media $media)
    {
        $this->media = $media;
    }





}
