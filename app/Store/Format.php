<?php
namespace App\Store;

use Carbon\Carbon;
use App\Utils\Common;
use Log;

class Format extends BaseStore
{
    protected $connection = 'mongodb';
    protected $table = 'binli_format';

    protected $fillable = [
        'name', //名称
        'status', //状态1显示；0不显示
        'sort', //排序
    ];
    public static function allListData($start, $length, $columns, $order, $key)
    {
        if($key){
            return self::select("*")->where('store_name', 'like', '%' . $key . '%')->skip(intval($start))->take(intval($length))->orderBy($columns, $order)->get();
        }else{
            return self::select("*")->skip(intval($start))->take(intval($length))->orderBy($columns, $order)->get();
        }
    }
    public static function countNumber($key)
    {
        if($key){
            return self::where('store_name', 'like', '%' . $key . '%')->count();
        }else{
            return self::count();
        }

    }

}