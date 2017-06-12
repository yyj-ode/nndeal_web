<?php

namespace App\Models;

use App\Jobs\CityName;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BinliCategory
 */
class Area extends BaseModel
{
    protected $connection = 'mysql';

    protected $table = 'area';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'status',
        'sort',
        'level',
        'path',
        'pid',
        'model',
        'description',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    public static function getDataById($id)
    {
        return self::with('category')->where('id', $id)->first();
    }

    public static function getByParentId($parent_id)
    {
        return self::where('parent_id', $parent_id)->get();
    }


    public function category()
    {
        return $this->belongsTo(Category::class, "parent_id", "id");
    }

    public static function allListData($start, $length, $columns, $order, $key)
    {
        if ($key) {
            return self::select("*")->where('name', 'like', '%' . $key . '%')->offset($start)->limit($length)->orderBy($columns, $order)->get();
        } else {
            return self::select("*")->offset($start)->limit($length)->orderBy($columns, $order)->get();
        }
    }

    public static function getAllData($parent_id, $columns, $order)
    {
        return self::select("*")->where(['parent_id' => $parent_id])->orderBy($columns, $order)->get();
    }

    public static function countNumber($parent_id)
    {
        return self::where(['parent_id' => $parent_id])->count();
    }

    public static function getEmail($email)
    {
        return self::where('email', $email)->first();
    }

    public static function getId($id)
    {
        return self::where('id', $id)->first();
    }
}