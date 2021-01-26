<?php

namespace App\Controller;

use App\Entity\Medicijn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VerzekeringsMedewerkerController extends AbstractController
{
    /**
     * @Route("/verzekerings/medewerker", name="verzekerings_medewerker")
     */
    public function index(): Response
    {
        return $this->render('verzekerings_medewerker/index.html.twig', [
            'controller_name' => 'VerzekeringsMedewerkerController',
        ]);
    }

    /**
     * @Route("/{id}/show", name="medicijn_show", methods={"GET"})
     */
    public function show(Medicijn $medicijn): Response
    {
        return $this->render('medicijn/show.html.twig', [
            'medicijn' => $medicijn,
        ]);
    }
}
