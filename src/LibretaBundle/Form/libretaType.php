<?php

namespace LibretaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class libretaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class)
            ->add('descripcion',TextType::class, array('attr' => array(
              'required' => 'unrequired'
            )))
            //->add('activo')
            //->add('usuario')
            ->add('tipo', EntityType::class, array(
                'class' => 'LibretaBundle:Tipo',
                'choice_label' => 'nombre',
                'multiple' => false,
                'expanded' => true
            ))
            ->add('Registrar',SubmitType::class, array('attr' => array(
              'class' => 'btn btn-primary'
            )))
            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LibretaBundle\Entity\libreta'
        ));
    }
}
