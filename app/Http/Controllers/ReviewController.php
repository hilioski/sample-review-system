<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use SimpleReviewSystem\Services\ReviewService;

class ReviewController extends Controller
{

    /**
     * @var
     */
    private $reviewService;

    /**
     * Review controller constructor.
     *
     * @param ReviewService $reviewService
     */
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return ResponseFactory
     */
    public function index()
    {
        return view('reviews.index');
    }
}
