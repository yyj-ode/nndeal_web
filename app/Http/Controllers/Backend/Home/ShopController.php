<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\Shop;
use App\Models\Power;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Http\Controllers\BackendController;

class ShopController extends BackendController
{
    /**
     * 显示首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('Backend.admin.shop.index');
    }

    /**
     * 获取首页数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexdata(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->get('start', '0');
            $length = $request->get('length', '10');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');
            $countData = Shop::countNumber();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = Shop::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir']);
            foreach ($data['data'] as $k=>$v){
                $data['data'][$k]['name'] = $v['users']['name'];
                $data['data'][$k]['mobile'] = $v['users']['mobile'];
            }
            return response()->json($data);
        }
    }

}
