<?php

namespace App\Controller;

use App\Entity\ResumeMe;
use App\Repository\ArticlesRepository;
use App\Repository\FormationsRepository;
use App\Repository\ResumeMeRepository;
use App\Repository\WorksRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
     * @param ResumeMeRepository $meRepository
     * @param WorksRepository $worksRepository
     * @param FormationsRepository $formationsRepository
     * @param ArticlesRepository $articlesRepository
     * @return Response
     * @throws DBALException
     */
    public function index(ResumeMeRepository $meRepository,WorksRepository $worksRepository, FormationsRepository $formationsRepository, ArticlesRepository $articlesRepository)
    {

        try {
            $works = $worksRepository->findDataRelationById($this->me->getId());

            foreach ($works as &$val){
                $temp = $worksRepository->getTechnosByWorksId($val['id']) ;
                if(!empty($temp)){
                    $val['techno'] = $temp;
                }
            }
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
     * @return Response
     */
    public function side()
    {
        return $this->render('default/_side.html.twig', [
            'me' => $this->me,
        ]);
    }

    /**
     * @param ArticlesRepository $articlesRepository
     * @return Response
     */
    public function nav(ArticlesRepository $articlesRepository)
    {

        $blog = $articlesRepository->findAll();
        $hiddenBlogMenu = true;
        if(!empty($blog)){
            foreach ($blog as $articles){
                if($articles->getIsPublished()){
                    $hiddenBlogMenu = false;
                }
            }
        }
        return $this->render('default/_nav.html.twig', [
            'hiddenBlogMenu' => $hiddenBlogMenu
        ]);
    }


}
