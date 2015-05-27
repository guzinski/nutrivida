<?php
namespace Nutrivida\LojaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of UsuarioType
 *
 * @author Luciano
 */
class UsuarioType extends AbstractType
{
    public function getName()
    {
        return "usuario";
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nome');
        $builder->add('email', "email");
        $builder->add('senha');
        $builder->add('nivel', 'entity', array(
                'class'         => 'NutrividaLojaBundle:Nivel',
                'empty_value'   => 'Selecione',
                'empty_data'    => null,
                'label'         => 'Nível'
        ));
        $builder->add('ativo', 'choice', array(
            'choices' => array('1' => 'Sim', '0' => 'Não'),
            'expanded' => true,
            'label' => "Ativo",
        ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
                        'data_class' => 'Nutrivida\LojaBundle\Entity\Usuario',
                    ));
    }
    
    
    

}
