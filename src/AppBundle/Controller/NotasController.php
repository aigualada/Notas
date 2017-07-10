<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Nota;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class NotasController
 * @package AppBundle\Controller
 * @Route("/api")
 */
class NotasController extends Controller
{

    /**
     * @param Request $request
     * @Route("/nota", name="crear_nota")
     * @Method("POST")
     */
    public function crearNota(Request $request)
    {
        $svc = $this->get('notas.service');

        $textNota = $request->get('texto');

        $nota = $svc->crearNota($textNota);

        return new JsonResponse($nota);

    }

    /**
     * @Route("/notas", name="notas")
     * @Method("GET")
     */
    public function getNotas()
    {
        $svc = $this->get('notas.service');

        return new JsonResponse(array('notas' => $svc->getNotas()));

    }

    /**
     * @param Request $request
     * @param $nota
     * @Route("/nota/{id}", name="consultar_nota")
     * @Method("GET")
     */
    public function getNota(Nota $nota)
    {
        return new JsonResponse(array('nota' => $nota));
    }

    /**
     * @param Request $request
     * @param Nota $nota
     * @Route("/nota/{id}/favorita", name="marcar_favorita")
     * @Method("PUT")
     */
    public function marcarNotaFavorita(Nota $nota)
    {
        $svc = $this->get('notas.service');

        $nota = $svc->marcarFavorita($nota);

        return new JsonResponse($nota);

    }

    /**
     * @Route("/notas/favoritas", name="notas_favoritas")
     * @Method("GET")
     */
    public function getNotasFavoritas()
    {

        $svc = $this->get('notas.service');

        return new JsonResponse($svc->getNotasFavoritas());

    }

}