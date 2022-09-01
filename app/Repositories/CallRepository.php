<?php

namespace App\Repositories;

use App\Models\CallRanking;
use Carbon\Carbon;

class CallRepository
{
    protected $model;

    public function __construct(CallRanking $model)
    {
        $this->model = $model;
    }

    /**
     * 電話数の増加
     */
    public function incrementCallCount($callParam)
    {
        if ($callParam) {
            $boat_id = $callParam->get('boat_id');
            $ranking_by_id = $this->model->where('boat_id', $boat_id)->select('call_count', 'updated_at', 'id')->get();
            $param = [
                'boat_id' => $boat_id,
                'call_count' => 1,
            ];

            if (count($ranking_by_id) != 0) {
                $from = Carbon::now()->startOfDay();
                $to = Carbon::now()->endOfDay();
                $id = $ranking_by_id[0]->id;

                if (($ranking_by_id[0]->updated_at >= $from) && ($ranking_by_id[0]->updated_at <= $to)) {
                    $param['call_count'] = $ranking_by_id[0] -> call_count + 1;                                        
                    return $this->model->updateData($id, collect($param));
                }else{    
                    return $this->model->updateData($id, collect($param));
                }
            } else {
                return $this->model->storeData(collect($param));
            }            
        }
    }

    /**
     * 電話番号リスト取得
     */
    public function fetchCallRankingList()
    {
        $from = Carbon::now()->startOfDay();
        $to = Carbon::now()->endOfDay();
        $query =  $this->model
                    ->leftJoin('boats', 'boat_id', 'boats.id')
                    ->leftJoin('lenders', 'lender_id', 'lenders.id')
                    ->leftJoin('cities', 'city_id', 'cities.id')
                    ->leftJoin('prefectures', 'lenders.prefecture_id', 'prefectures.id')
                    ->whereBetween('call_rankings.updated_at', [$from, $to])
                    ->select(
                        'boat_name',
                        'call_count',
                        'city_name',
                        'prefecture_name',
                        'member_type_id',
                    )
                    ->get();
        return  $query;
    }
}
