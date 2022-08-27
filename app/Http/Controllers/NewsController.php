<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsService;
use App\Http\Requests\NewsRequest;
// use App\Enums\Util;

// use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    protected $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }
    /*-------------------------------------------*/
    /* ADMIN/NEWS
    /*-------------------------------------------*/
    /**
      * ニュースリストを取得
      *
      * @authenticated
      * @group News
      * @param Request $request
      */
    public function index(Request $request): object
    {
        $sortKey = $request->get('sort_key');
        $orderBy = $request->get('order_by');
        return $this->service->fetchNewIndex($sortKey, $orderBy);
    }

    /**
     * ニュースリストを 新規登録
     *
     * @param Request $request
     * @return void
     */
    public function store(NewsRequest $request)
    {
        return $this->service->storeNews($request);
    }

    /**
     * ニュース 詳細取得
     *
     * @authenticated
     * @group News
     * @param mixed $id
     */
    public function show($id)
    {
        return $this->service->fetchNewsShow($id);
    }

    /**
     * ニュース 更新
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(NewsRequest $request, int $id)
    {
        return $this->service->updateNews($request, $id);
    }

    /**
     * ニュース 削除
     *
     * @authenticated
     * @group News
     * @param mixed $id
     */
    public function destroy($id)
    {
        return $this->service->deleteNews($id);
    }
}
