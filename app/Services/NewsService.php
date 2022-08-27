<?php

namespace App\Services;

use App\Enums\HttpStatus;
use App\Repositories\NewsRepository;
// use Illuminate\Support\Facades\Log;

class NewsService
{
    protected $repository;

    public function __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }
    /*-------------------------------------------*/
    /* ADMIN/NEWS
    /*-------------------------------------------*/
    /**
     * ニュースリストを取得
     */
    public function fetchNewIndex($sortKey, $orderBy)
    {
        return $this->repository->fetchNewIndex($sortKey, $orderBy);
    }

    /**
     * ニュースリストを 新規登録
     */
    public function storeNews($request)
    {
        $city = $this->repository->storeNews($request);
        return response()->json($city, HttpStatus::CREATED);
    }

    /**
     * ニュース 詳細取得
     */
    public function fetchNewsShow($id)
    {
        return $this->repository->fetchNewsShow($id);
    }

    /**
     * ニュース 更新
     */
    public function updateNews($id, $request)
    {
        return $this->repository->updateNews($id, $request);
    }

    /**
     * ニュース 削除
     */
    public function deleteNews($id)
    {
        return $this->repository->deleteNews($id);
    }
}
