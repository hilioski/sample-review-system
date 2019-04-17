<?php

namespace SimpleReviewSystem\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ReviewRepository extends BaseRepository
{
    public function model()
    {
        return "App\\Models\\Review";
    }
}
