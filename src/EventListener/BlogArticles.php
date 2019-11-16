<?php

namespace App\EventListener;

use App\Entity\Articles;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class BlogArticles
{

    /*
     * keep the example if need use later
     * Work with comment example in the service.yaml
     * TODO : learn more on LifecycleEvent
     * */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if(!$entity instanceof Articles){
            return;
        }
        $em = $args->getObjectManager();
    }


    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if(!$entity instanceof Articles){
            return;
        }
        $em = $args->getObjectManager();
    }
}