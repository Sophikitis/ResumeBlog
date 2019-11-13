<?php

namespace App\Controller;

use KMS\FroalaEditorBundle\KMSFroalaEditorBundle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


use FroalaEditor_Image;
class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/blog/delete_image", name="blog.image.delete")
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteImage(Request $request)
    {
        try {
            $response = FroalaEditor_Image::delete($request->get('src'));
            return new JsonResponse(['success' => 1]);
        }
        catch (Exception $e) {
            return new JsonResponse(['error' => 'Token invalide'], 400);
        }
    }


}
