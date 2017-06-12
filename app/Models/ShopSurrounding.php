<?php

namespace App\Models;

use App\Store\ShopSurroundingStore;

/**
 * Class BinliCategory
 */
class ShopSurrounding extends ShopSurroundingStore
{
    public $timestamps = true;

    protected $guarded = [];

    public static function getDataById($id)
    {
        return self::find($id);
    }

    public static function getByParentId()
    {
        return self::get();
    }

    public static function countNumber()
    {
        return self::count();
    }

    public function format()
    {
        return $this->belongsTo(Format::class, "categories", "id");
    }

    /**
     * 获取省份信息
     * 因province字段在前台某部分已经使用，此处用'province1'避免冲突
     * @return mixed
     */
    public function province1()
    {
        return $this->belongsTo(Area::class, "province", "id");
    }

    public function city1()
    {
        return $this->belongsTo(Area::class, "city", "id");
    }

    public function county1()
    {
        return $this->belongsTo(Area::class, "county", "id");
    }

    public static function allListData($start, $length, $columns, $order)
    {
        return self::with('format','province1','city1','county1')->skip(intval($start))->limit(intval($length))->orderBy($columns, $order)->get()->toArray();
    }

    public static function getAll($type = "CN", $parent_id = 0)
    {
        return self::select("*")->where(['show' => 1, 'type' => $type, 'parent_id' => $parent_id])->orderBy('id', 'asc')->get();
    }
}