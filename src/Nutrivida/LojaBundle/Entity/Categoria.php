<?php

namespace Nutrivida\LojaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="Nutrivida\LojaBundle\Entity\Repository\CategoriaRepository")
 */
class Categoria
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
     * @var integer
     *
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $nome;
    
    /**
     *
     * @var Collection
     * @ORM\OneToMany(targetEntity="Produto", mappedBy="categoria") 
     */
    private $produtos;


    function __construct()
    {
        $this->setProdutos(new ArrayCollection());
    }

        /**
     * Set nome
     *
     * @param integer $nome
     * @return Categoria
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return integer 
     */
    public function getNome()
    {
        return $this->nome;
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
     * Get produtos
     * 
     * @return Collection
     */
    function getProdutos()
    {
        return $this->produtos;
    }

    /**
     * Set produtos
     * 
     * @param Collection $produtos
     */
    function setProdutos(Collection $produtos)
    {
        $this->produtos = $produtos;
    }
    
    public function __toString()
    {
        return $this->nome;
    }



}
