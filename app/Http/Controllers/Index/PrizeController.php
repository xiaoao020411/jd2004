<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PrizeModel;

class PrizeController extends Controller
{
    function prize(){
        return view('index.prize');
    }
    function add(){
        $uid = session('login')->id;
        $time1 = strtotime(date("Y-m-d"));
        $res = PrizeModel::where(['uid'=>$uid])->where("add_time",">=",$time1)->first();
        if($res){
            $response = [
                'error' => 4343,
                'msg'   => '今天已抽奖，明天再来'
            ];
            return $response;
        } 
        if(session('login')){
            $rand = mt_rand(1,10000);
        //echo $rand;
        $level = 0;
        if($rand>=1 && $rand<=10){
            $level = 1;
        }elseif($rand>=11 && $rand<=100){
            $level = 2;
        }elseif($rand>=101 && $rand<=500){
            $level = 3;
        }
        
        $prize_data = [
            'uid'       => $uid,
            'level'     => $level,
            'add_time'  => time()
        ];

        $pid = PrizeModel::insertGetId($prize_data);
        if($pid>0)
        {
            $data=[
            'error'=>0,
            'msg'=>'ok',
            'data'=>[
                'rand'=>$rand,
                'level'=>$level
            ]
            ];
        }else{
            $response = [
                'error' => 1717,
                'msg'   => '网关错误'
            ];
            return $response;
        }
        
        return $data;
    }else{
        $response = [
            'error' => 400003,
            'msg'   => '未登录'
        ];
        return $response;
    }
        }
        
}
