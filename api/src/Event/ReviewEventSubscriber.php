<?php

namespace App\Event;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Review;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ReviewEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var \App\Repository\BookRepository
     */
    private $bookRepository;
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(BookRepository $reviewRepository, EntityManagerInterface $entityManager)
    {
        $this->bookRepository = $reviewRepository;
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [['calculateAverageRate' , EventPriorities::POST_WRITE]],
        ];
    }

    public function calculateAverageRate(ViewEvent $event)
    {
        $review = $event->getControllerResult();
        if (!$review instanceof Review){
            return false;
        }

        $rateSum = 0;
        $rateCount=0;
        $book = $this->bookRepository->findOneBy(['id' => $review->getBook()->getId()]);
        foreach($book->getReviews() as $review ){
            $rateSum += $review->getRate();
            $rateCount++;
        }
        $averageRate = $rateSum/$rateCount;
        $book->setAverageReviewRate($averageRate);
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}
