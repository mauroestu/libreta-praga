<?php

namespace LibretaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LibretaBundle\Form\libretaType;
use LibretaBundle\Form\notaType;
use LibretaBundle\Entity\libreta;
use LibretaBundle\Entity\nota;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LibretaController extends Controller
{

    //Crea una nueva libreta
    public function crearLibretaAction(Request $request)
    {
        if($this->getUser() == null) return $this->redirectToRoute('login');

        $libreta = new libreta();
        $libreta->setActivo(true);
        $libreta->setUsuario($this->getUser());
        //Instancia del formulario de Registro de nueva libreta
        $form = $this->createForm(libretaType::class,$libreta);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $libreta = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($libreta);
            $em->flush();

            return $this->redirectToRoute('inicio');
        }

        return $this->render('LibretaBundle:Default:index.html.twig', array('formLibreta' => $form->createView(), 'render' => 2 ));
    }

    public function borrarLibretaAction($idLibreta)
    {
      if($this->getUser() == null) return $this->redirectToRoute('login');
      try
      {
          $em = $this->getDoctrine()->getEntityManager();
          $libreta = $em->getRepository("LibretaBundle:libreta")->find($idLibreta);
          $em->remove($libreta);
          $em->flush();

          return $this->redirectToRoute('inicio');
      }
      catch(\Exception $err)
      {
          return new Response('La libreta tiene notas asociadas. <a href="/inicio">Inicio</a>');
      }

    }

    public function verNotasAction($idLibreta)
    {
        if($this->getUser() == null) return $this->redirectToRoute('login');
        $notas = $this->getDoctrine()->getRepository('LibretaBundle:nota')->findBy(['libreta' => $idLibreta]);
        $libreta = $this->getDoctrine()->getRepository('LibretaBundle:libreta')->find($idLibreta);
        return $this->render('LibretaBundle:Default:index.html.twig', array('notas' => $notas , 'libreta' => $libreta,'render' => 4));
    }

    //Crea una nueva nota asociada a una libreta
    public function crearNotaAction(Request $request)
    {
        if($this->getUser() == null) return $this->redirectToRoute('login');
        $nota = new nota();
        $nota->setActivo(true);
        //Instancia del formulario de Registro de nueva nota
        $form = $this->createForm(notaType::class,$nota);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $nota = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($nota);
            $em->flush();

            return $this->redirectToRoute('inicio');
        }

        return $this->render('LibretaBundle:Default:index.html.twig', array('formNota' => $form->createView(), 'render' => 3 ));
    }

    public function actualizarNotaAction(Request $request, $idNota)
    {
        if($this->getUser() == null) return $this->redirectToRoute('login');
        $nota = $this->getDoctrine()->getRepository('LibretaBundle:nota')->find($idNota);
        $form = $this->createForm(notaType::class,$nota);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          $em = $this->getDoctrine()->getManager();
          $em->persist($nota);
          $em->flush();
          return $this->redirectToRoute('inicio');
        }

        return $this->render('LibretaBundle:Default:index.html.twig', array('formNota' => $form->createView(), 'render' => 3 ));
    }

    public function borrarNotaAction($idNota)
    {
        if($this->getUser() == null) return $this->redirectToRoute('login');
        $em = $this->getDoctrine()->getEntityManager();
        $nota = $em->getRepository("LibretaBundle:nota")->find($idNota);
        $em->remove($nota);
        $em->flush();

        return $this->redirectToRoute('inicio');
    }
}
