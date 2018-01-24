<?php
// src/DataFixtures/AppFixtures.php
namespace LibretaBundle\DataFixtures\ORM;

use LibretaBundle\Entity\Tipo;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures implements FixtureInterface
{

    /**
    * Load function which enters the types of notes to the table Tipo
    *
    * @author Mauricio Estuardo Batres Montejo
    *
    * @param ObjectManager  $manager Symfony ORM manager.
    *
    * @return nothing
    *
    */
    public function load(ObjectManager $manager)
    {

        $NoteBookTypes = array(
          Tipo::CONST_NOTA_MENTAL => 'Notas mentales',
          Tipo::CONST_NOTA_ENTRETENIMIENTO => 'Notas de entretenimiento',
          Tipo::CONST_NOTA_ACADEMICA => 'Notas académicas'
        );

        foreach ($NoteBookTypes as $id => $name) {
            $Type = new Tipo();
            $Type->setId($id);
            $Type->setNombre($name);
            $Type->setActivo(true);
            $manager->persist($Type);
        }

        $manager->flush();
    }
}
