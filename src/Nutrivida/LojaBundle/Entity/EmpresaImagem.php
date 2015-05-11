<?php

namespace Nutrivida\LojaBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * EmpresaImagem
 *
 * @ORM\Table(name="empresa_imagem", indexes={@ORM\Index(name="FK__empresa", columns={"empresa"})})
 * @ORM\Entity
 */
class EmpresaImagem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Media
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"}, fetch="LAZY")
     */
    private $media;

    /**
     * @var Empresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="imagens")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="empresa", referencedColumnName="id")
     * })
     */
    private $empresa;

    function __construct(Media $media = null, Empresa $empresa = null)
    {
        $this->media = $media;
        $this->empresa = $empresa;
    }

    
    /**
     * 
     * @return Media
     */
    function getMedia()
    {
        return $this->media;
    }

    /**
     * 
     * @param Media $media
     */
    function setMedia(Media $media)
    {
        $this->media = $media;
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set empresa
     *
     * @param Empresa $empresa
     * @return EmpresaImagem
     */
    public function setEmpresa(Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return Empresa 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }
}
