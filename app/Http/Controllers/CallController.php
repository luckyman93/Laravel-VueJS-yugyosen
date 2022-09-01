<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CallService;

class CallController extends Controller
{
    protected $service;

    public function __construct(CallService $service)
    {
        $this->service = $service;
    }
    /*-------------------------------------------*/
    /* VIEWER *認証なし
    /*-------------------------------------------*/
    /**
     * 電話数の増加
     *
     * @return object
     */
    public function incrementCallCount(Request $request)
    {
        return $this->service->incrementCallCount($request);
    }

    /**
     * 電話番号リスト取得
     */
    public function fetchCallRankingList()
    {
        return $this->service->fetchCallRankingList();
    }
}
