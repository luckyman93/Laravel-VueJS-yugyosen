<?php

namespace App\Repositories;

use App\Models\Plan;

class PlanRepository
{
    protected $model;

    public function __construct(Plan $model)
    {
        $this->model = $model;
    }

    /**
     * 計画取得
     *
     * @authenticated
     * @group plan
     * @param Request $request
     */
    public function fetchPlanIndex($lenderId):object
    {
        $query = $this->model
            ->where('lender_id', $lenderId)
            ->get();
        
        return $query;
    }

    /**
     * 計画 登録
     */
    public function storePlan($request)
    {
        return $this->model->storeData(collect($request));
    }

    /**
     * 計画 更新取得
     */
    public function updatePlan($request, $id)
    {
        return $this->model->updateData($id, collect($request));
    }
}
