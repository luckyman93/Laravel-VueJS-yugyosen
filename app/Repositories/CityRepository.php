<?php

namespace App\Repositories;

use App\Models\City;
use App\Enums\Util;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CityRepository
{
    protected $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    /**
     * 市区町村 一覧取得
     *
     * @authenticated
     * @group City
     * @param Request $request
     */
    public function fetchCityIndex($sortKey, $orderBy, $keyword): object
    {
        $query = $this->model
            ->leftJoin('users as created_user', 'created_user.id', 'cities.created_user_id')
            ->leftJoin('users as updated_user', 'updated_user.id', 'cities.updated_user_id')
            ->whereNull('cities.deleted_at')
            ->select(
                'cities.id',
                'cities.city_name',
                'cities.url_param',
                'cities.comment',
                'cities.created_at',
                'cities.updated_at',
                'created_user.name as created_user_name',
                'created_user.name as updated_user_name',
            );
        if ($keyword) {
            $keywordArray = explode(',', $keyword);
            $query = $query->where(function ($query) use ($keywordArray) {
                foreach ($keywordArray as $word) {
                    if (!empty($word)) {
                        $k = '%'.$word.'%';
                        $query->where(function ($q) use ($k) {
                            $q->orWhere('city_name', 'like', $k)
                                ->orWhere('comment', 'like', $k);
                        });
                    }
                }
            });
        }
        return $query->orderby($sortKey, $orderBy)->paginate(Util::PAGINATE_COUNT);
    }

    public function fetchCityList()
    {
        return $this->model->get();
    }

    /**
     * 市区町村 詳細取得
     */
    public function fetchCityShow($id)
    {
        return $this->model->find($id);
    }

    /**
     * 市区町村 新規登録
     */
    public function storeCity($request)
    {
        return $this->model->storeData(collect($request));
    }


    /**
     * 市区町村 更新取得
     */
    public function fetchUpdateCity($request, $id)
    {
        return $this->model->updateData($id, collect($request));
    }

    /**
     * 都道府県 削除
     */
    public function deleteCity($id)
    {
        return $this->model->deleteData($id);
    }

    /**
     * 市町村 市町村 詳細取得（name）
     *
     * @param [type] $cityParam
     * @return void
     */
    public function fetchCityByUrlParam($cityParam)
    {
        $city =  $this->model->where('url_param', $cityParam)->first();
        $query = DB::table('lenders')
        ->leftJoin('ports', 'lenders.port_id', 'ports.id')
        ->leftJoin('cities', 'ports.city_id', 'cities.id')
        ->where('lenders.city_id', $city->id)
        ->select(
            'ports.port_name',
            'ports.city_id',
            'ports.comment',
            'ports.created_at',
            'ports.created_user_id',
            'ports.deleted_at',
            'ports.id',
            'ports.port_name_kana',
            'ports.updated_at',
            'ports.updated_user_id',
            'cities.url_param',
        )
        ->get();
        $port = $this->model->with('ports')->find($city->id);
        $port->lender_ports = $query;
        return $port;
    }

    /**
     * 市町村 都道府県毎のリスト取得
     *
     * @param integer $id
     * @return void
     */
    public function fetchCityListByPrefecture(int $id)
    {
        return $this->model->where('prefecture_id', $id)->get();
    }
}
