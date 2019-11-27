<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends AbstractController
{

    // return list all articles
    /*
     * [] Pagination
     * [] Request
     * */
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticlesRepository $articlesRepository)
    {


        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articlesRepository->findAll()
        ]);
    }

    /**
     * @Route("/blog/{slug}-{id}", name="blog.show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show(Articles $articles, Request $request, string $slug)
    {
        if ($articles->getSlug() !== $slug) {
            return $this->redirectToRoute('blog', [
                'id' => $articles->getId(),
                'slug' => $articles->getSlug()
            ], 301);
        }


        return $this->render('blog/show.html.twig', [
            'article' => $articles,
            'back' => true
        ]);

    }
}
