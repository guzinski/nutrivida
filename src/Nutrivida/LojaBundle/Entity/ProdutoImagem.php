<?php

namespace Nutrivida\LojaBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoImagem
 *
 * @ORM\Table(name="produto_imagem", indexes={@ORM\Index(name="FK__produto", columns={"produto"})})
 * @ORM\Entity
 */
class ProdutoImagem
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
     * @var Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto", inversedBy="imagens")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto", referencedColumnName="id")
     * })
     */
    private $produto;
    
    
    function __construct(Media $media = null, Produto $produto = null)
    {
        $this->media = $media;
        $this->produto = $produto;
    }

    function getMedia()
    {
        return $this->media;
    }

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
     * Set produto
     *
     * @param Produto $produto
     * @return ProdutoImagem
     */
    public function setProduto(Produto $produto = null)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get produto
     *
     * @return Produto 
     */
    public function getProduto()
    {
        return $this->produto;
    }
}
