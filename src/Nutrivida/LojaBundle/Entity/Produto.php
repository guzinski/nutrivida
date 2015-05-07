<?php

namespace Nutrivida\LojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produto
 *
 * @ORM\Table(name="produto", indexes={@ORM\Index(name="FK__categoria", columns={"categoria"})})
 * @ORM\Entity
 */
class Produto
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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=150, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=true)
     */
    private $descricao;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=10, scale=0, nullable=false)
     */
    private $valor;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="produtos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria", referencedColumnName="id")
     * })
     */
    private $categoria;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     * @OneToMany(targetEntity="ProdutoImagem", mappedBy="produto")
     **/
    private $imagens;
    
    function __construct()
    {
        $this->setImagens(new \Doctrine\Common\Collections\ArrayCollection());
    }    

    /**
     * Set nome
     *
     * @param string $nome
     * @return Produto
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Produto
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set valor
     *
     * @param float $valor
     * @return Produto
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return float 
     */
    public function getValor()
    {
        return $this->valor;
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
     * Set categoria
     *
     * @param \Nutrivida\LojaBundle\Entity\Categoria $categoria
     * @return Produto
     */
    public function setCategoria(\Nutrivida\LojaBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Nutrivida\LojaBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
    
    /**
     * Get imagens
     * 
     * @return \Doctrine\Common\Collections\Collection
     */
    function getImagens()
    {
        return $this->imagens;
    }

    /**
     * Set imagens
     * 
     * @param \Doctrine\Common\Collections\Collection $imagens
     */
    function setImagens(\Doctrine\Common\Collections\Collection $imagens)
    {
        $this->imagens = $imagens;
    }

}
