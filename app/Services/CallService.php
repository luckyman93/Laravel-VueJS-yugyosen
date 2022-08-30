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
     * 市町村 都道府県毎のリスト取得
     */
}
