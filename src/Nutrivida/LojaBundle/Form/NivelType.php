<?php

namespace Nutrivida\LojaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of NivelType
 *
 * @author Luciano
 */
class NivelType extends AbstractType
{
    
    public function getName()
    {
        return "nivel";
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('permissoes', 'entity', array(
                'class'         => 'NutrividaLojaBundle:Permissao',
                'label'         => 'Permissões',
                'multiple'      => true,
                'expanded'      => true,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nutrivida\LojaBundle\Entity\Nivel',
        ));
    }

    
}
