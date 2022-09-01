<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlanService;
use App\Http\Requests\PlanRequest;

class PlanController extends Controller
{
    protected $service;

    public function __construct(PlanService $service)
    {
        $this->service = $service;
    }
    /*-------------------------------------------*/
    /* LENDER/PLAN
    /*-------------------------------------------*/
    /**
      * 計画取得
      *
      * @authenticated
      * @group plan
      * @param Request $request
      */
    public function index(): object
    {
        return $this->service->fetchPlanIndex();
    }

    /**
     * 計画 登録
     *
     * @param Request $request
     * @return void
     */
    public function store(PlanRequest $request)
    {
        return $this->service->storePlan($request);
    }

    /**
     * 計画 更新
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(PlanRequest $request, int $id)
    {
        return $this->service->updatePlan($request, $id);
    }
}
