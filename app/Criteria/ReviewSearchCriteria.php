<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ReviewSearchCriteria.
 *
 * @package namespace App\Criteria;
 */
class ReviewSearchCriteria implements CriteriaInterface
{
    /**
     * @var string $keyword
     */
    protected $keyword;

    public function __construct(string $keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('text','LIKE', '%'.$this->keyword.'%');

        return $model;
    }
}
