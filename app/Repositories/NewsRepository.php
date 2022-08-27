<?php

namespace App\Repositories;

use App\Models\News;
// use App\Enums\Util;
// use Illuminate\Support\Facades\Log;

class NewsRepository
{
    protected $model;

    public function __construct(News $model)
    {
        $this->model = $model;
    }

    /**
     * ニュースリストを 取得
     *
     * @authenticated
     * @group news
     * @param Request $request
     */
    public function fetchNewIndex($sortKey, $orderBy): object
    {
        $query = $this->model->orderby($sortKey, $orderBy)->get();
        
        return $query;
    }

    /**
     * ニュース 詳細取得
     */
    public function fetchNewsShow($id)
    {
        return $this->model->find($id);
    }

    /**
     * ニュースリストを 新規登録
     */
    public function storeNews($request)
    {
        return $this->model->storeData(collect($request));
    }


    /**
     * ニュース 更新取得
     */
    public function updateNews($request, $id)
    {
        return $this->model->updateData($id, collect($request));
    }

    /**
     * ニュース 削除
     */
    public function deleteNews($id)
    {
        return $this->model->deleteData($id);
    }
}
