<?php

namespace App\Services;

use App\Repositories\CallRepository;

class CallService
{
    protected $repository;

    public function __construct(CallRepository $repository)
    {
        $this->repository = $repository;
    }

    /*-------------------------------------------*/
    /* VIEWER *認証なし
    /*-------------------------------------------*/
    /**
     * 電話数の増加
     */
    public function incrementCallCount($callParam)
    {
        return $this->repository->incrementCallCount($callParam);
    }
    /**
     * 電話番号リスト取得
     */
    public function fetchCallRankingList()
    {
        return $this->repository->fetchCallRankingList();
    }
}
