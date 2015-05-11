<?php

namespace Nutrivida\LojaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

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
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=false)
     */
    private $descricao;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="EmpresaImagem", mappedBy="empresa", cascade={"all"})
     **/
    private $imagens;

    function __construct()
    {
        $this->setImagens(new ArrayCollection());
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




}
