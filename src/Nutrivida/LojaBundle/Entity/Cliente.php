<?php

namespace Nutrivida\LojaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Nutrivida\LojaBundle\Entity\Pedido;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * News
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity
 */
class Cliente
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
     * @var integer
     *
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $email;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $senha;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Pedido", mappedBy="cliente")
     **/
    private $pedidos;

    
    public function __construct()
    {
        $this->setPedidos(new ArrayCollection());
    }
    
    function getId()
    {
        return $this->id;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getPedidos()
    {
        return $this->pedidos;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setSenha($senha)
    {
        $this->senha = $senha;
    }

    function setPedidos(Collection $pedidos)
    {
        $this->pedidos = $pedidos;
    }

}
