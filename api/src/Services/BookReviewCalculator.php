<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Book;
use App\Entity\Review;

class BookReviewCalculator
{
    public function calculate(Book $book): float
    {
        /** @var Review $review */
        $reviews = $book->getReviews()->map(
            function (Review $review) {
                return $review->getRate();
            }
        )->getValues();

        return round(array_sum($reviews) / $book->getReviews()->count(), 2);
    }
}
