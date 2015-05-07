<?php

namespace Nutrivida\LojaBundle\Entity;

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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=150, nullable=false)
     */
    private $nome;

    /**
     * @var \Empresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="imagens")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="empresa", referencedColumnName="id")
     * })
     */
    private $empresa;



    /**
     * Set nome
     *
     * @param string $nome
     * @return EmpresaImagem
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
     * Set empresa
     *
     * @param \Nutrivida\LojaBundle\Entity\Empresa $empresa
     * @return EmpresaImagem
     */
    public function setEmpresa(\Nutrivida\LojaBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \Nutrivida\LojaBundle\Entity\Empresa 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }
}
