<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
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
     * @param Request $request
     *
     * @return ResponseFactory
     */
    public function index(Request $request)
    {
        if($request->has('keyword')){
            return response($this->reviewService->getAll($request->keyword));
        }

        return response($this->reviewService->getAll());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReviewRequest $request
     *
     * @return ResponseFactory
     */
    public function store(StoreReviewRequest $request)
    {
        try {
            $review = $this->reviewService->store($request->only([ 'name', 'text', 'score' ]));
        } catch (Exception $e) {
            return response([ 'message' => 'Something went wrong! Please try again.' ], 500);
        }

        return response($review, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $reviewId
     *
     * @return ResponseFactory
     */
    public function destroy($reviewId)
    {
        try {
            $this->reviewService->delete($reviewId);
        } catch (Exception $e) {
            return response([ 'message' => 'Something went wrong! Please try again.' ], 500);
        }

        return response('', 204);
    }
}
