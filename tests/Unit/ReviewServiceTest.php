<?php

namespace Tests\Unit;


use App\Models\Review;
use Illuminate\Pagination\LengthAwarePaginator;
use SimpleReviewSystem\Services\ReviewService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var ReviewService $reviewService
     */
    private $reviewService;

    /**
     * @var Review $review
     */
    private $review;

    /**
     * Setup the test environment.
     *
     * @return void
     * @throws
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->reviewService = app()->make(ReviewService::class);
        $this->review = factory(Review::class)->create();
    }

    /**
     * @test
     */
    public function it_returns_all_reviews_paginated()
    {
        $reviews = $this->reviewService->getAll();

        $this->assertInstanceOf(LengthAwarePaginator::class, $reviews);
    }

    /**
     * @test
     */
    public function it_returns_all_reviews_paginated_and_filtered_by_keyword()
    {
        $reviews = $this->reviewService->getAll('keyword');

        $this->assertInstanceOf(LengthAwarePaginator::class, $reviews);
    }

    /**
     * @test
     */
    public function it_returns_review_if_successfully_added_in_db()
    {
        $dataArray = [
            'name'  => 'Hristian Ilioski',
            'text'  => 'Test text...',
            'score' => 5,
        ];

        $review = $this->reviewService->store($dataArray);

        $this->assertInstanceOf(Review::class, $review);
        $this->assertEquals($dataArray['name'], $review['name']);
        $this->assertEquals($dataArray['text'], $review['text']);
        $this->assertEquals($dataArray['score'], $review['score']);
    }

    /**
     * @test
     */
    public function it_returns_true_if_successfully_removed_from_db()
    {
        $review = $this->reviewService->delete($this->review->id);

        $this->assertIsBool($review);
        $this->assertEquals($review, true);
    }
}
