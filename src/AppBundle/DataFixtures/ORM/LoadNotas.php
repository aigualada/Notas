<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Nota;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNotas extends AbstractFixture
{

    const NUM_NOTAS = 20;

    protected $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < self::NUM_NOTAS; $i++)
        {
            $nota = new Nota();
            $nota->setTexto($this->faker->text(140));
            $nota->setFavorita($this->faker->boolean(30));

            $manager->persist($nota);

            $this->setReference('nota-' . $i, $nota);

        }

        $manager->flush();
    }


}