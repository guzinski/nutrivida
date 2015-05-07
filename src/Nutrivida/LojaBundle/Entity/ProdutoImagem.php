<?php

namespace Nutrivida\LojaBundle\Entity;

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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=150, nullable=false)
     */
    private $nome;

    /**
     * @var \Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto", inversedBy="imagens")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto", referencedColumnName="id")
     * })
     */
    private $produto;



    /**
     * Set nome
     *
     * @param string $nome
     * @return ProdutoImagem
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
     * @param \Nutrivida\LojaBundle\Entity\Produto $produto
     * @return ProdutoImagem
     */
    public function setProduto(\Nutrivida\LojaBundle\Entity\Produto $produto = null)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get produto
     *
     * @return \Nutrivida\LojaBundle\Entity\Produto 
     */
    public function getProduto()
    {
        return $this->produto;
    }
}
