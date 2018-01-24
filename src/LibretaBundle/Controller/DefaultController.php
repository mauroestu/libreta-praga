<?php

namespace LibretaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LibretaBundle\Form\UsuarioType;
use LibretaBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
    * Render the user registration form and save new users.
    *
    * @author Mauricio Estuardo Batres Montejo.
    *
    * @param Request $request
    *
    * @return $this->render()
    */
    public function showRegistroAction(Request $request)
    {
        if($this->getUser() != null) return $this->redirectToRoute('inicio');

        $usuario = new Usuario();
        $usuario->setActivo(true);
        //Instancia del formulario de Registro de Usuario
        $formRegistro = $this->createForm(UsuarioType::class,$usuario);
        $formRegistro->handleRequest($request);

        if($formRegistro->isSubmitted() && $formRegistro->isValid())
        {
            //Codificamos el password
            $password = $this->get('security.password_encoder')->encodePassword($usuario, $usuario->getPlainPassword());
            $usuario->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            //lo hacemos persistente en la base de datos.
            $em->persist($usuario);
            //Guardamos cambios.
            $em->flush();

            return new Response("Usuario Registrado");
        }
        //Renderizamos el formulario de registro
        return $this->render('LibretaBundle:Default:register.html.twig',array("form" => $formRegistro->createView() ));
    }

    /**
    *
    *
    *
    *
    *
    */
    public function inicioAction()
    {
        if($this->getUser() == null) return $this->redirectToRoute('login');

        $repositorio = $this->getDoctrine()->getRepository('LibretaBundle:libreta');
        $libretas = $repositorio->findBy(['usuario' => $this->getUser()]);

        return $this->render('LibretaBundle:Default:index.html.twig', array('libretas' => $libretas ,'render' => 1));
    }

    //Login de usuario
    public function showLoginAction(Request $request)
    {
          if($this->getUser() != null) return $this->redirectToRoute('inicio');

          $authenticationUtils = $this->get('security.authentication_utils');
          // Obtener el login de error
          $error = $authenticationUtils->getLastAuthenticationError();
          // Obtener el ultimo usuario ingresado
          $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('LibretaBundle:Default:login.html.twig', array(
                  'last_username' => $lastUsername,
                  'error'         => $error,
              )
          );
    }

}
