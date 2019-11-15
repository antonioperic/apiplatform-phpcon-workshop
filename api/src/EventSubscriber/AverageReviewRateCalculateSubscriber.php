<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Review;
use App\Repository\BookRepository;
use App\Services\BookReviewCalculator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class AverageReviewRateCalculateSubscriber implements EventSubscriberInterface
{
    /** @var BookRepository */
    private $bookRepository;
    /** @var BookReviewCalculator */
    private $calculator;

    public function __construct(BookRepository $bookRepository, BookReviewCalculator $calculator)
    {
        $this->bookRepository = $bookRepository;
        $this->calculator = $calculator;
    }

    public function recalculate(ViewEvent $event)
    {
        /** @var Review $review */
        $review = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$review instanceof Review || $method !== 'POST'){
            return;
        }
        $rating = $this->calculator->calculate($review->getBook());
        return $this->bookRepository->updateAverageReviewRate($review->getBook(), $rating);
    }

    public static function getSubscribedEvents()
    {
        return [
            ViewEvent::class => ['recalculate', EventPriorities::POST_WRITE],
        ];
    }
}
