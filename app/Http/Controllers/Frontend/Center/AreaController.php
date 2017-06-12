<?php

namespace App\Http\Controllers\Frontend\Center;

use App\Jobs\AddArea;
use App\Models\Area;
use App\Store\AreaStore;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;

class AreaController extends FrontendController
{

    /**
     * 获取所有下一级数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function category(Request $request)
    {
        $id = $request->get('id');
        $data = AreaStore::getByParentIds($id);
        return response()->json($data);
    }
}
