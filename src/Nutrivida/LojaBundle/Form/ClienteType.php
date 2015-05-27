<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nutrivida\LojaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of ClienteType
 *
 * @author Luciano
 */
class ClienteType extends AbstractType
{
    
    public function getName()
    {
        return "cliente";
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nome');
        $builder->add('email', "email");
        $builder->add("senha", 'repeated', array(
                            'type' => 'password',
                            'invalid_message' => 'Senha não são iguais.',
                            'required' => true,
                            'first_options'  => array('label' => 'Senha'),
                            'second_options' => array('label' => 'Repetir Senha'),
                    ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                        'data_class' => 'Nutrivida\LojaBundle\Entity\Cliente',
                    ));
    }

    
}
