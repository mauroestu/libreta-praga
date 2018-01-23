<?php

namespace LibretaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class notaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nota',TextType::class)
            ->add('contenido',TextareaType::class, array("attr" => array("id" => "summernote")))
            //->add('activo')
            ->add('libreta', EntityType::class, array(
                'class' => 'LibretaBundle:libreta',
                'choice_label' => 'nombre',
                'multiple' => false,
                'expanded' => true
            ))
            ->add('Guardar Nota',SubmitType::class, array('attr' => array(
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
            'data_class' => 'LibretaBundle\Entity\nota'
        ));
    }
}
