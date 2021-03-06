<?php

namespace App\Models;

/**
 * Class BinliCategory
 */
class Collection extends BaseModel
{
    protected $connection = 'mysql';

    protected $table = 'collection';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'users_id',
        'shop_id',
    ];

    protected $guarded = [];

    public static function getDataById($id)
    {
        return self::with('users','shop')->where('id', $id)->first();
    }

    public static function getByParentId()
    {
        return self::get();
    }

    public static function countNumber()
    {
        return self::count();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "parent_id", "id");
    }

    public static function allListData($start, $length, $columns, $order, $parent_id)
    {
        return self::with('users','shop')->offset($start)->limit($length)->orderBy($columns, $order)->get()->toArray();
    }
    public function users(){
        return $this->belongsTo(User::class, "users_id", "id");
    }
    public function shop(){
        return $this->belongsTo(Shop::class, "shop_id", "id");
    }

    public static function getAll($type = "CN", $parent_id = 0)
    {
        return self::select("*")->where(['show' => 1, 'type' => $type, 'parent_id' => $parent_id])->orderBy('id', 'asc')->get();
    }
}