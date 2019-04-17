<?php

namespace SimpleReviewSystem\Services;

use App\Models\Review;
use Illuminate\Pagination\LengthAwarePaginator;
use SimpleReviewSystem\Repositories\ReviewRepository;
use Exception;

class ReviewService
{

    /**
     * @var
     */
    private $reviewRepository;


    /**
     * Review service constructor.
     *
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }


    /**
     * Return all reviews.
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->reviewRepository->paginate();
    }


    /**
     * Store new review.
     *
     * @param array $dataArray
     *
     * @return Review
     * @throws Exception
     */
    public function store(array $dataArray): Review
    {
        try {
            $review = $this->reviewRepository->create($dataArray);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $review;
    }


    /**
     * Delete review.
     *
     * @param int $reviewId
     *
     * @return bool
     * @throws Exception
     */
    public function delete(int $reviewId): bool
    {
        try {
            $review = $this->reviewRepository->delete($reviewId);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $review;
    }
}