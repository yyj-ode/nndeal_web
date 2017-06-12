<?php

namespace App\Models;

use App\Jobs\CityName;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BinliUser
 */
class Order extends BaseModel
{
    protected $connection = 'mysql';

    protected $table = 'order';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'first_name',
        'category_id',
        'mobile',
        'unit_price',
        'brand',
        'email',
        'type',
        'service',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    public static function getDataById($id)
    {
        return self::where('id', $id)->first();
    }

    public static function allListData($start, $length, $columns, $order)
    {
        return self::select("*")->offset($start)->limit($length)->orderBy($columns, $order)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public static function getData($start, $length, $columns, $order,$key)
    {
       if($key){
           return self::with('user')->where('order_number','like','%'.$key.'%')->offset($start)->limit($length)->orderBy($columns, $order)->get();
       }else{
           return self::with('user')->offset($start)->limit($length)->orderBy($columns, $order)->get();
       }

    }

    public static function countNumber()
    {
        return self::count();
    }
    public static function getUsersData($user_id){
        return self::with('user')->where('user_id',$user_id)->get();
    }

}