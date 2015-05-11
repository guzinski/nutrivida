<?php
namespace Nutrivida\LojaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of ProdutoTyoe
 *
 * @author Luciano
 */
class ProdutoTyoe extends AbstractType
{
    public function getName()
    {
        return "produto";
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
                $builder->add('nome');
                $builder->add('descricao', 'textarea', array("label"=> "Descrição"));
                $builder->add('valor', 'money', array("currency"=>"", "grouping"=>false));
                $builder->add('categoria', 'entity', array(
                        'class'         => 'NutrividaLojaBundle:Categoria',
                        'empty_value'   => 'Selecione',
                        'empty_data'    => null,
                        'label'         => 'Categoria'
                ));
                $builder->add('destaqueCategoria', 'choice', array(
                    'choices' => array('1' => 'Sim', '0' => 'Não'),
                    'expanded' => true,
                    'label' => "Destaqeu da Categoria",
                ));
                $builder->add('desconto', 'choice', array(
                    'choices' => array('1' => 'Sim', '0' => 'Não'),
                    'expanded' => true,
                    'label' => "Destaqeu da Categoria",
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
                        'data_class' => 'Nutrivida\LojaBundle\Entity\Produto',
                    ));
    }
    
    
    

}
