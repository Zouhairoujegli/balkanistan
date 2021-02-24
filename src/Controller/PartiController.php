<?php

namespace App\Controller;

use App\Entity\Parti;
use App\Form\PartiType;
use App\Repository\PartiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/parti")
 */
class PartiController extends AbstractController
{
    /**
     * @Route("/", name="parti_index", methods={"GET"})
     * 
     */
    public function index(PartiRepository $partiRepository): Response
    {
        return $this->render('parti/index.html.twig', [
            'partis' => $partiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="parti_new", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_REMEMBERED")
     */
    public function new(Request $request): Response
    {
        $parti = new Parti();
        $form = $this->createForm(PartiType::class, $parti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parti);
            $entityManager->flush();

            return $this->redirectToRoute('parti_index');
        }

        return $this->render('parti/new.html.twig', [
            'parti' => $parti,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parti_show", methods={"GET"})
     */
    public function show(Parti $parti,PartiRepository $partiRepository): Response
    {
        $moyenne = $partiRepository->moyenneAge($parti->getId());
        $nombreFemme = $partiRepository->nombre($parti->getId(),'femme');
        $nombrehomme = $partiRepository->nombre($parti->getId(),'homme');
       // dd($nombreFemme);
        return $this->render('parti/show.html.twig', [
            'parti' => $parti,
            'moyenne' =>$moyenne,
            'nombreFemme' => $nombreFemme,
            'nombrehomme' => $nombrehomme
        ]);
    }

    /**
     * @Route("/{id}/edit", name="parti_edit", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_REMEMBERED")
     */
    public function edit(Request $request, Parti $parti): Response
    {
        $form = $this->createForm(PartiType::class, $parti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parti_index');
        }

        return $this->render('parti/edit.html.twig', [
            'parti' => $parti,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parti_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Parti $parti): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parti->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parti);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parti_index');
    }
}
