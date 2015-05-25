<?php

namespace Nutrivida\LojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 * @UniqueEntity("email", message="Já existe um usuário com esse e-mail cadastrado")
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario implements UserInterface
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
     * @ORM\Column(name="email", type="string", length=150, nullable=false, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=150, nullable=false)
     */
    private $senha;

    
    /**
     * @var Nivel
     *
     * @ORM\ManyToOne(targetEntity="Nivel", inversedBy="usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nivel", referencedColumnName="id")
     * })
     */
    private $nivel;
    
    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $ativo = 0;



    /**
     * Set nome
     *
     * @param string $nome
     * @return Usuario
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
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set senha
     *
     * @param string $senha
     * @return Usuario
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get senha
     *
     * @return string 
     */
    public function getSenha()
    {
        return $this->senha;
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
    
    public function getNivel()
    {
        return $this->nivel;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setNivel(Nivel $nivel)
    {
        $this->nivel = $nivel;
        return $this;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }
    
    public function eraseCredentials()
    {
        
    }

    public function getPassword()
    {
        return $this->senha;
    }

    public function getRoles()
    {
        $roles = array();
        foreach ($this->getNivel()->getPermissoes() as $permissao) {
            $roles [] = $permissao->getRole();
        }
        $roles [] = "ROLE_USER";
        var_dump($roles);
        //die();
        return $roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }



}
