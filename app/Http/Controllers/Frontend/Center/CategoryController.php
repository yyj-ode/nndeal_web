<?php

namespace App\Http\Controllers\Frontend\Center;

use App\Jobs\AddCategory;
use App\Models\Category;
use App\Store\CategoryStore;
use Illuminate\Http\Request;
use App\Models\Question;

use App\Http\Requests;
use App\Http\Controllers\FrontendController;

class CategoryController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * 获取所有下一级数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function category(Request $request)
    {
        $id = $request->get('id');
        $data = CategoryStore::getByParentIds($id);
        return response()->json($data);
    }

    /**
     * 判断是不是最后栏目
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request)
    {
        $id = $request->get('id');
        $data = CategoryStore::checkByParentId($id);
        $result = ['status' => $data ? 1 : 2];
        return response()->json($result);
    }
}
