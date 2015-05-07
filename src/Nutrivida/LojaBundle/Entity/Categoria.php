<?php

namespace Nutrivida\LojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity
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
     * @ORM\Column(name="nome", type="integer", nullable=false)
     */
    private $nome;
    
    /**
     *
     * @var \Doctrine\Common\Collections\Collection
     * @OneToMany(targetEntity="Produto", mappedBy="categoria") 
     */
    private $produtos;


    function __construct()
    {
        $this->setProdutos(new \Doctrine\Common\Collections\ArrayCollection());
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
     * @return \Doctrine\Common\Collections\Collection
     */
    function getProdutos()
    {
        return $this->produtos;
    }

    /**
     * Set produtos
     * 
     * @param \Doctrine\Common\Collections\Collection $produtos
     */
    function setProdutos(\Doctrine\Common\Collections\Collection $produtos)
    {
        $this->produtos = $produtos;
    }


}
