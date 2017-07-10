<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Nota
 * @package AppBundle\Entity
 * @ORM\Entity
 */
class Nota
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $texto;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $favorita;

    public function __construct()
    {
        $this->favorita = false;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set texto
     *
     * @param string $texto
     *
     * @return Nota
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set favorita
     *
     * @param boolean $favorita
     *
     * @return Nota
     */
    public function setFavorita($favorita)
    {
        $this->favorita = $favorita;

        return $this;
    }

    /**
     * Get favorita
     *
     * @return boolean
     */
    public function getFavorita()
    {
        return $this->favorita;
    }
}
