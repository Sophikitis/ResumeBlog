<?php

namespace App\Controller;

use App\Entity\ResumeMe;
use App\Repository\FormationsRepository;
use App\Repository\ResumeMeRepository;
use App\Repository\WorksRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;


class SummaryResumeController extends AbstractController
{


    /**
     * @Route("/summary/{id}", name="summary_resume")
     * @param Request $request
     * @param ResumeMeRepository $meRepository
     * @param WorksRepository $worksRepository
     * @param FormationsRepository $formationsRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\DBAL\DBALException
     */
    public function index(Request $request, ResumeMeRepository $meRepository, WorksRepository $worksRepository, FormationsRepository $formationsRepository)
    {
        $id = $request->get('id');

        $me = $meRepository->find($id);
        $works = $worksRepository->findDataRelationById($id);
        $formations = $formationsRepository->findDataRelationById($id);



        return $this->render('summary_resume/index.html.twig', [
            'controller_name' => 'SummaryResumeController',
            'infos' => $me,
            'works' => $works,
            'formations' => $formations,

        ]);
    }
      /**
       * @Route("/summary/edit/{entity}/{id}", name="summary_resume_edit")
       **/
    public function edit(Request $request){

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $request->get('id'),
            'entity' => $request->get('entity'),
        ));
    }
}
