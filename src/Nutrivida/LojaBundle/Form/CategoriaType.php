<?php

namespace Nutrivida\LojaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of Categoria
 *
 * @author Luciano
 */
class CategoriaType extends AbstractType
{
    
    public function getName()
    {
        return "categoria";
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nome');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
                        'data_class' => 'Nutrivida\LojaBundle\Entity\Categoria',
                    ));
    }


}
