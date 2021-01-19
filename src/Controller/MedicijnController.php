<?php

namespace App\Controller;

use App\Entity\Medicijn;
use App\Form\MedicijnType;
use App\Repository\MedicijnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/medicijn")
 */
class MedicijnController extends AbstractController
{
    /**
     * @Route("/", name="medicijn_index", methods={"GET"})
     */
    public function index(MedicijnRepository $medicijnRepository): Response
    {
        return $this->render('medicijn/index.html.twig', [
            'medicijns' => $medicijnRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="medicijn_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $medicijn = new Medicijn();
        $form = $this->createForm(MedicijnType::class, $medicijn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medicijn);
            $entityManager->flush();

            return $this->redirectToRoute('medicijn_index');
        }

        return $this->render('medicijn/new.html.twig', [
            'medicijn' => $medicijn,
            'form' => $form->createView(),
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

    /**
     * @Route("/{id}/edit", name="medicijn_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Medicijn $medicijn): Response
    {
        $form = $this->createForm(MedicijnType::class, $medicijn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medicijn_index');
        }

        return $this->render('medicijn/edit.html.twig', [
            'medicijn' => $medicijn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="medicijn_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Medicijn $medicijn): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medicijn->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medicijn);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medicijn_index');
    }
}
