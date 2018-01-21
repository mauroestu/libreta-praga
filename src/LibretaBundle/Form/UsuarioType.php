<?php

namespace LibretaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
          ->add('nombreCompleto',TextType::class, array('label' => 'Nombre Completo', 'attr' => array(
            'PlaceHolder' => "Nombre Completo"
          )))
          ->add('username',TextType::class, array('label' => 'Usuario', 'attr' => array(
            'PlaceHolder' => "Usuario"
          )))
          ->add('email',EmailType::class, array('label' => 'Email','attr' => array(
            'PlaceHolder' => "Email"
          )))
          ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repetir Contraseña')
            ))
          ->add('Guardar',SubmitType::class, array('attr' => array(
            'class' => 'btn btn-primary'
          )))
          //->add('activo')
          ;
          /*{{ form_row(form.nombreCompleto) }}
          {{ form_row(form.username) }}
          {{ form_row(form.email) }}
          {{ form_row(form.password) }}
          {{ form_row(form.Registrar) }}*/
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LibretaBundle\Entity\Usuario'
        ));
    }
}
