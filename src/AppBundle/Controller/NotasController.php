<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Nota;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class NotasController extends Controller
{

    /**
     * @param Request $request
     * @Route("/api/nota", name="crear_nota")
     * @Method("POST")
     */
    public function crearNota(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $textNota = $request->get('texto');

        $nota = new Nota();

        $nota->setTexto($textNota);

        $em->persist($nota);
        $em->flush();

        return new JsonResponse($nota);

    }

    /**
     * @Route("/api/notas", name="notas")
     * @Method("GET")
     */
    public function getNotas()
    {
        $em = $this->getDoctrine()->getManager();

        $notas = $em->getRepository('AppBundle:Nota')->findAll();

        return new JsonResponse(json_encode($notas));

    }

    /**
     * @param Request $request
     * @param $nota
     * @Route("/api/nota/{id}", name="consultar_nota")
     * @Method("GET")
     */
    public function getNota(Request $request, Nota $nota)
    {
        return new JsonResponse($nota);
    }

    /**
     * @param Request $request
     * @param Nota $nota
     * @Route("/api/nota/{id}/favorita", name="marcar_favorita")
     * @Method("PUT")
     */
    public function marcarNotaFavorita(Request $request, Nota $nota)
    {
        $em = $this->getDoctrine()->getManager();

        $nota->setFavorita(true);
        $em->flush();

        return new JsonResponse($nota);

    }

    /**
     * @Route("/api/notas/favoritas", name="notas_favoritas")
     * @Method("GET")
     */
    public function getNotasFavoritas()
    {

        $em = $this->getDoctrine()->getManager();

        $notasFavoritas = $em->getRepository('AppBundle:Nota')->findBy(array('favorita' => true));

        return new JsonResponse($notasFavoritas);

    }

}