<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use KMS\FroalaEditorBundle\KMSFroalaEditorBundle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FroalaEditor_Image;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;



/*TODO :
[] delete folder who containt image of article when delete article
*/


class BlogController extends EasyAdminController
{
    /**
     * @var ArticlesRepository
     */
    private $articlesRepository;


    /**
     * BlogController constructor.
     * @param ArticlesRepository $articlesRepository
     */
    public function __construct(ArticlesRepository $articlesRepository)
    {

        $this->articlesRepository = $articlesRepository;
    }


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


    // Overdrive function for delete folder who contain the images of article
    /**
     * @param object $entity
     */
    protected function removeEntity($entity)
    {
        $filesystem = new Filesystem();
        $path = getcwd()."/uploads/blog/articles/".$entity->uuid;

       parent::removeEntity($entity);

        if ($filesystem->exists($path)) {
            $filesystem->remove($path);
        }
    }



    // Creates the form builder used to create the form rendered in the
    // create and edit actions
    protected function createEntityFormBuilder($entity, $view)
    {

        dump($entity->getSlug());

        /*
         * TODO : find solution more clean
         * */
        if(empty($_POST)) {
            if(!isset($entity->uuid))
            {
                $uuid = uniqid();
            }else{
                $uuid = $entity->uuid;
            }
        }elseif ($_POST['articles']['uuid']){
            $uuid = $_POST['articles']['uuid'];
        }

        $builder = parent::createEntityFormBuilder($entity, $view);

        /*
         * custom form with the froalaEditor and custom path uploadFolder
         * */
        $builder->add("title", TextType::class, array(
            "label" => false,
            'attr' => array(
                'placeholder' => "Titre de l'article",
            )
        ))
            ->add( "body", FroalaEditorType::class, array(
            "language" => "fr",
            "imageUploadFolder" => "/uploads/blog/articles/$uuid",
            "imageUploadPath" => "/uploads/blog/articles/$uuid",
            "toolbarInline" => false,
            "tableColors" => [ "#FFFFFF", "#FF0000" ],
            "saveParams" => [ "id" => "myEditorField" ],
            "label" => false,
                "heightMin" => "400",
                "heightMax" => "450",
        ))
        ->add("uuid", HiddenType::class, array(
            "data" => $uuid
        ))
        ->add('coverImageFile', VichImageType::class, array(
            "label" => false,
            'required' => false
        ))
    ;

        return $builder;

    }

}
