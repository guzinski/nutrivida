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
                $builder->add('peso', 'money', array("currency" => "", "grouping" => false, "label" => "Peso do produto (com em balagem em Kg)"));
                $builder->add('largura', 'money', array("currency"=>"", "grouping"=>false, "label" => "Largura da Embalagem em cm"));
                $builder->add('comprimento', 'money', array("currency"=>"", "grouping"=>false, "label" => "Comprimento da Embalagem em cm"));
                $builder->add('altura', 'money', array("currency"=>"", "grouping"=>false, "label" => "Altura da Embalagem em cm"));
                $builder->add('categorias', 'entity', array(
                        'class'         => 'NutrividaLojaBundle:Categoria',
                        "multiple"      => true,
                        "expanded"      => true,
                        'label'         => 'Categorias'
                ));
                $builder->add('destaqueCategoria', 'choice', array(
                    'choices' => array('1' => 'Sim', '0' => 'Não'),
                    'expanded' => true,
                    'label' => "Destaque da Categoria",
                ));
                $builder->add('tipoEmbalagem', 'choice', array(
                    'choices' => array('1' => 'Caixa/Pacote', '2' => 'Rolo/Prisma'),
                    'expanded' => true,
                    'label' => "Formato da Embalagem Embalagem",
                ));
                
                $builder->add('desconto', 'choice', array(
                    'choices' => array('1' => 'Sim', '0' => 'Não'),
                    'expanded' => true,
                    'label' => "Desconto",
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
