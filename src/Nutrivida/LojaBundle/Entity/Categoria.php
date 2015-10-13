<?php

namespace Nutrivida\LojaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nutrivida\LojaBundle\Entity\Repository\CategoriaRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation\Slug;
/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="Nutrivida\LojaBundle\Entity\Repository\CategoriaRepository")
 * @UniqueEntity(
 *     fields={"nome"},
 *     message="Já existe uma categoria com esse nome"
 * )
 **/
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
     * @ORM\Column(type="string", length=150, nullable=false, unique=true)
     */
    private $nome;
    
    /**
     * @Slug(fields={"nome"})
     * @ORM\Column(length=150, unique=true)
     */
    private $slug;
    
    /**
     *
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Produto", mappedBy="categorias") 
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

    function getSlug()
    {
        return $this->slug;
    }

    function setSlug($slug)
    {
        $this->slug = $slug;
    }



}
