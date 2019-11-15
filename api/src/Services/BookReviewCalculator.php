<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Book;
use App\Entity\Review;

class BookReviewCalculator
{
    public function calculate(Book $book): float
    {
        $sum = 0;
        /** @var Review $review */
        foreach ($book->getReviews() as $review){
            $sum += $review->getRate();
        }

        return round($sum/$book->getReviews()->count(), 2);
    }
}
