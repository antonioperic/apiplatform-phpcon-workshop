<?php namespace App\Subscribers;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Review;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ReviewEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }


    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [['countAverage', EventPriorities::POST_WRITE]],
        ];
    }

    public function countAverage(GetResponseForControllerResultEvent $event)
    {
        $review = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$review instanceof Review || !in_array($method, ['POST', 'PUT', 'DELETE'])) {
            return;
        }

        $book = $review->getBook();
        $reviews = $book->getReviews()->toArray();

        $rates = array_map(function ($review) {
            return $review->getRate();
        }, $reviews);

        $sum = array_sum($rates);
        $average = $sum / count($reviews);

        $book->setAverageReviewRate($average);
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}
