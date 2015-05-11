<?php
namespace Nutrivida\LojaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of BannerType
 *
 * @author Luciano
 */
class BannerType extends AbstractType
{
    public function getName()
    {
        return "banner";
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
                $mediaManager = $options['em'];
                $builder->add('nome');
                $builder->add(
                        $builder->create('media', 'hidden')
                                ->addModelTransformer(new MediaTransformer($mediaManager))
                );
                $builder->add('ativo', 'choice', array(
                    'choices' => array('1' => 'Sim', '0' => 'Não'),
                    'expanded' => true,
                    'label' => "Ativo",
                ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
                        'data_class' => 'Nutrivida\LojaBundle\Entity\Banner',
                    ))
                    ->setRequired(array(
                        'em',
                    ));
    }


}
