<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use KMS\FroalaEditorBundle\KMSFroalaEditorBundle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FroalaEditor_Image;


class BlogController extends EasyAdminController
{
    /**
     * @Route("/admin/blog/upload_image", name="admin.blog.image.upload")
     * @return JsonResponse
     */
    public function uploadedImage()
    {
        try {
            $response = FroalaEditor_Image::upload('/uploads/blog/');
            return new JsonResponse($response);
        }
        catch (Exception $e) {
            return new JsonResponse(['error' => 'image not uploaded'], 400);
        }
    }

    /**
     * @Route("/admin/blog/delete_image", name="admin.blog.image.delete")
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
            return new JsonResponse(['error' => 'error'], 400);
        }
    }


}
