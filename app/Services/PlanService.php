<?php

namespace App\Services;

use App\Enums\HttpStatus;
use App\Repositories\PlanRepository;

class PlanService
{
    protected $repository;

    public function __construct(PlanRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /*-------------------------------------------*/
    /* LENDER/PLAN
    /*-------------------------------------------*/
    /**
     * 計画取得
     */
    public function fetchPlanIndex($lenderId):object
    {
        return $this->repository->fetchPlanIndex($lenderId);
    }

    /**
     * 計画 登録
     */
    public function storePlan($request)
    {
        $plan = $this->repository->storePlan($request);
        return response()->json($plan, HttpStatus::CREATED);
    }

    /**
     *計画 更新
     */
    public function updatePlan($id, $request)
    {
        return $this->repository->updatePlan($id, $request);
    }
}
