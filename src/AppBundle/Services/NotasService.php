<?php

namespace AppBundle\Services;

use AppBundle\Entity\Nota;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Serializer;

class NotasService
{

    protected $entityManager;

    protected $serializer;

    /**
     * NotasService constructor.
     * @param EntityManager $entityManager
     * @param Serializer $serializer
     */
    public function __construct(EntityManager $entityManager, Serializer $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }


    /**
     * @param $texto
     * @return Nota
     */
    public function crearNota($texto)
    {
        $nota = new Nota();

        $nota->setTexto($texto);

        $this->entityManager->persist($nota);

        $this->entityManager->flush();

        return $this->serializer->serialize($nota, 'json');
    }

    /**
     * @return Nota[]|array
     */
    public function getNotas()
    {
        $notas = $this->entityManager->getRepository('AppBundle:Nota')->findAll();

        return $this->serializer->serialize($notas, 'json');
    }

    /**
     * @param Nota $nota
     * @return Nota
     */
    public function marcarFavorita(Nota $nota)
    {
        $nota->setFavorita(true);

        $this->entityManager->flush();

        return $this->serializer->serialize($nota, 'json');
    }

    /**
     * @return Nota[]|array
     */
    public function getNotasFavoritas()
    {

        $notasFavoritas = $this->entityManager
            ->getRepository('AppBundle:Nota')
            ->findBy(array('favorita' => true));

        return $this->serializer->serialize($notasFavoritas, 'json', array('encode' => 'UTF-8'));

    }

}