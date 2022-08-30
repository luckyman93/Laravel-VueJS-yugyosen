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
            $call_count = $this->model->where('boat_id', $boat_id)->select('call_count', 'updated_at')->get();
            if ($call_count[0]) {
                $from = Carbon::now()->startOfDay();
                $to = Carbon::now()->endOfDay();
                if (($call_count[0]->updated_at >= $from) && ($call_count[0]->updated_at <= $to)){
                    $call = [
                        'boat_id' => $boat_id,
                        'call_count' => $call_count[0]->call_count+1,
                    ];

                    return $call;

                }else{    
                    echo "Current date is not between two dates";  
                }
            } else {
                echo "new"; 
            }
            
        }
        // return $today;
        // return $this->model->storeData(collect($callParam));
    }
}
