<?php

namespace Nutrivida\LojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity
 */
class Empresa
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
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=false)
     */
    
    private $descricao;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @OneToMany(targetEntity="EmpresaImagem", mappedBy="empresa")
     **/
    private $imagens;

    function __construct( $imagens)
    {
        $this->setImagens(new \Doctrine\Common\Collections\ArrayCollection());
    }

    
    /**
     * Set nome
     *
     * @param integer $nome
     * @return Empresa
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
     * Set descricao
     *
     * @param string $descricao
     * @return Empresa
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
