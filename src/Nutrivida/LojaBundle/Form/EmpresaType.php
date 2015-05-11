<?php

namespace Nutrivida\LojaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of EmpresaType
 *
 * @author Luciano
 */
class EmpresaType extends AbstractType
{
    public function getName()
    {
        return "empresa";
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
                $builder->add('nome');
                $builder->add('descricao', 'textarea', array("label"=> "Descrição"));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
                        'data_class' => 'Nutrivida\LojaBundle\Entity\Empresa',
                    ));
    }

}
