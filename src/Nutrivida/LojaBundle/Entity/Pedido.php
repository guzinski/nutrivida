<?php

namespace Nutrivida\LojaBundle\Entity;

use Nutrivida\LojaBundle\Entity\Cliente;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="pedido")
 * @ORM\Entity
 */
class Pedido
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
     * @var Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="pedidos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente", referencedColumnName="id")
     * })
     */
    private $cliente;
    
    
    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Produto", inversedBy="pedidos", cascade={"persist"})
     * @ORM\JoinTable(name="produto_pedido",
     *   joinColumns={
     *     @ORM\JoinColumn(name="pedido", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="produto", referencedColumnName="id")
     *   }
     * )
     */
    private $produtos;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $data;


    
    public function __construct()
    {
        $this->setData(new \DateTime("now"));
        $this->setProdutos(new ArrayCollection());
    }
    
    function getId()
    {
        return $this->id;
    }

    function getCliente()
    {
        return $this->cliente;
    }

    function getProdutos()
    {
        return $this->produtos;
    }

    function getData()
    {
        return $this->data;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    function setProdutos(Collection $produtos)
    {
        $this->produtos = $produtos;
    }

    function setData(DateTime $data)
    {
        $this->data = $data;
    }


    
}
