<?php
namespace Nutrivida\LojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * Description of ProdutoPedido
 *
 * @author Luciano
 * 
 * @ORM\Table(name="produto_pedido", indexes={
 *                                              @ORM\Index(name="FK__produto_pedido_produto", columns={"produto"}),
 *                                              @ORM\Index(name="FK__produto_pedido_pedido", columns={"pedido"})
 *                                            })
 * @ORM\Entity
 */
class ProdutoPedido
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
     * @var Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto", referencedColumnName="id")
     * })
     */
    private $produto;
    
    /**
     * @var Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido", inversedBy="produtosPedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido", referencedColumnName="id")
     * })
     */
    private $pedido;
    
    /**
     * @var int
     *
     * @ORM\Column(name="quantidade", type="integer", nullable=false)
     */
    private $quantidade = 0;


    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=false)
     */
    private $valorUnitario;

    
    public function getProduto()
    {
        return $this->produto;
    }

    public function getPedido()
    {
        return $this->pedido;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function getValorUnitario()
    {
        return $this->valorUnitario;
    }

    public function setProduto(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function setPedido(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function setValorUnitario($valorUnitario)
    {
        $this->valorUnitario = $valorUnitario;
    }

    public function getId()
    {
        return $this->id;
    }

    
    
}
