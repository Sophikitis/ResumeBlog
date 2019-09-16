<?php

namespace App\Controller;

use App\Entity\ResumeMe;
use App\Form\ResumeMeType;
use App\Repository\ResumeMeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/resume/me")
 */
class ResumeMeController extends AbstractController
{
    /**
     * @Route("/", name="resume_me_index", methods={"GET"})
     */
    public function index(ResumeMeRepository $resumeMeRepository): Response
    {
        return $this->render('resume_me/login.html.twig', [
            'resume_mes' => $resumeMeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="resume_me_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $resumeMe = new ResumeMe();
        $form = $this->createForm(ResumeMeType::class, $resumeMe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resumeMe);
            $entityManager->flush();

            return $this->redirectToRoute('resume_me_index');
        }

        return $this->render('resume_me/new.html.twig', [
            'resume_me' => $resumeMe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resume_me_show", methods={"GET"})
     */
    public function show(ResumeMe $resumeMe): Response
    {
        return $this->render('resume_me/show.html.twig', [
            'resume_me' => $resumeMe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="resume_me_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ResumeMe $resumeMe): Response
    {
        $form = $this->createForm(ResumeMeType::class, $resumeMe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resume_me_index');
        }

        return $this->render('resume_me/edit.html.twig', [
            'resume_me' => $resumeMe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resume_me_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ResumeMe $resumeMe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resumeMe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($resumeMe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('resume_me_index');
    }
}
