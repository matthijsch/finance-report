<?php

namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use App\Entity\MutationAccount;
use odannyc\GoogleImageSearch\ImageSearch;
use Exception;

class GoogleImageSubscriber implements EventSubscriber
{
    /**
     * @var string
     */
    private $uploadPath;

    /**
     * @param string $uploadPath
     */
    public function __construct(string $uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    /**
     * subscribed events.
     */
    public function getSubscribedEvents(): array
    {
        return [
            'postPersist',
        ];
    }

    /**
     *  post persist.
     *
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args): void
    {
        //$this->searchGoogleImage($args);
    }

    /**
     * search google for logo of company.
     *
     * @param LifecycleEventArgs $args
     */
    public function searchGoogleImage(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();

        if ($entity instanceof MutationAccount && empty($entity->getImage())) {
            ImageSearch::config()->apiKey('AIzaSyBcJ3z-lbphpCkUTATYqd1Ga6hcST9CXnM');
            ImageSearch::config()->cx('011660356548771952977:x6o4wph0ux8');

            try {
                $results = ImageSearch::search($entity->getCompany().' logo');

                if (!isset($results['items']) || !isset($results['items'][0])) {
                    return;
                }

                $image = @file_get_contents($results['items'][0]['link']);

                if (!empty($image)) {
                    $imagePath = $this->uploadPath.'/'.md5($results['items'][0]['link']);

                    file_put_contents($imagePath, $image, LOCK_EX);
                    $entity->setImage($imagePath);
                }
            } catch (Exception $e) {
            }
        }
    }
}
