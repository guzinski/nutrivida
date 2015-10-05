<?php

namespace Nutrivida\LojaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Produto
 *
 * @ORM\Table(name="produto")
 * @ORM\Entity(repositoryClass="Nutrivida\LojaBundle\Entity\Repository\ProdutoRepository")
 * @UniqueEntity(
 *     fields={"nome"},
 *     message="O nome deste produto já está cadastrado"
 * )
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
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descricao;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=false)
     */
    private $valor;
    
    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=false)
     */
    private $peso = 1;
    
    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=false)
     */
    private $largura = 1;
    
    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=false)
     */
    private $comprimento = 1;
    
    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=false)
     */
    private $altura = 1;
    
    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $tipoEmbalagem = 1;

    
    /**
     * @Slug(fields={"nome"})
     * @ORM\Column(length=150, unique=true)
     */
    private $slug;


    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Categoria", inversedBy="produtos")
     * @ORM\JoinTable(name="produto_categoria",
     *   joinColumns={
     *     @ORM\JoinColumn(name="produto", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="categoria", referencedColumnName="id")
     *   }
     * )
     */
    private $categorias;
    
    /**
     * @var int
     *
     * @ORM\Column(name="destaque_categoria", type="integer", nullable=false)
     */
    private $destaqueCategoria = 0;
    
    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $ativo = 0;
    
    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $desconto = 0;
    
    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Pedido", mappedBy="produtos")
     */
    private $pedidos;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="ProdutoImagem", mappedBy="produto", fetch="EAGER", cascade={"all"})
     **/
    private $imagens;
    
    function __construct()
    {
        $this->setImagens(new ArrayCollection());
        $this->setCategorias(new ArrayCollection());
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
     * Get imagens
     * 
     * @return Collection
     */
    function getImagens()
    {
        return $this->imagens;
    }

    /**
     * Set imagens
     * 
     * @param Collection $imagens
     */
    function setImagens(Collection $imagens)
    {
        $this->imagens = $imagens;
    }
    
    
    function getDestaqueCategoria()
    {
        return $this->destaqueCategoria;
    }

    function getAtivo()
    {
        return $this->ativo;
    }

    function setDestaqueCategoria($destaqueCategoria)
    {
        $this->destaqueCategoria = $destaqueCategoria;
    }

    function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    function getDesconto()
    {
        return $this->desconto;
    }

    function getPedidos()
    {
        return $this->pedidos;
    }

    function setDesconto($desconto)
    {
        $this->desconto = $desconto;
    }

    function setPedidos(Collection $pedidos)
    {
        $this->pedidos = $pedidos;
    }

    function getSlug()
    {
        return $this->slug;
    }

    function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function getLargura()
    {
        return $this->largura;
    }

    public function getComprimento()
    {
        return $this->comprimento;
    }

    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    public function setLargura($largura)
    {
        $this->largura = $largura;
    }

    public function setComprimento($comprimento)
    {
        $this->comprimento = $comprimento;
    }


    public function getAltura()
    {
        return $this->altura;
    }

    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    public function getTipoEmbalagem()
    {
        return $this->tipoEmbalagem;
    }

    public function setTipoEmbalagem($tipoEmbalagem)
    {
        $this->tipoEmbalagem = $tipoEmbalagem;
    }
    
    public function getCategorias()
    {
        return $this->categorias;
    }

    public function setCategorias(Collection $categorias)
    {
        $this->categorias = $categorias;
    }



}
