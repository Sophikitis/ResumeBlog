<?php

namespace App\Controller;

use App\Entity\ResumeMe;
use App\Repository\FormationsRepository;
use App\Repository\ResumeMeRepository;
use App\Repository\WorksRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    private $me;

    public function __construct(ResumeMeRepository $meRepository)
    {
        $this->me = $meRepository->findFirst();
    }

    /**
     * @Route("/", name="homepage")
     * @throws \Doctrine\DBAL\DBALException
     */
    public function index(ResumeMeRepository $meRepository,WorksRepository $worksRepository, FormationsRepository $formationsRepository)
    {

        try {
            $works = $worksRepository->findDataRelationById($this->me->getId());
            $formations = $formationsRepository->findDataRelationById($this->me->getId());
        } catch (NoResultException $e) {
        } catch (NonUniqueResultException $e) {
        }


        return $this->render('default/index1.html.twig', [
            'controller_name' => 'DefaultController',
            'me' => $this->me,
            'works' => $works,
            'educations' => $formations,
        ]);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menu()
    {
        return $this->render('default/_menu.html.twig', [
            'me' => $this->me,
        ]);
    }
}
