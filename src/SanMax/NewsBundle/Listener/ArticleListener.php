<?php
namespace SanMax\NewsBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use SanMax\NewsBundle\Entity\Article;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ArticleListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface $ts
     */
    public function __construct(TokenStorageInterface $ts)
    {
        $this->tokenStorage = $ts;
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function prePersist(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        if($entity instanceof Article) {

            $entity->setAuthor($this->tokenStorage->getToken()->getUser());

        }
    }
} 