<?php

namespace App\Http\Controllers\Backend\Home;

use App\Store\AreaStore;
use App\Store\ShopOnline;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class ShopOnlineController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        if ($request->ajax()) {
            $search = $request->get('search');//获取前台传过来的过滤条件
            $parent_id = $request->get('parent_id');//获取前台传过来的过滤条件
            $start = $request->get('start', '0');
            $length = $request->get('length', '10');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');
            if (count($search) != 0 && !empty($search['value'])) {
                $parent_id = $search['value'];
            }
            $countData = ShopOnline::countNumber($parent_id);
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = ShopOnline::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $parent_id);
            return response()->json($data);
        }
        return view('Backend.admin.shoponline.index', compact('parent_id'));
    }
    public function indexdata(Request $request){
        if ($request->ajax()) {
            $search = $request->get('search');//获取前台传过来的过滤条件
            $parent_id = $request->get('parent_id');//获取前台传过来的过滤条件
            $start = $request->get('start', '0');
            $length = $request->get('length', '10');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');
            if (count($search) != 0 && !empty($search['value'])) {
                $parent_id = $search['value'];
            }
            $countData = ShopOnline::countNumber($parent_id);
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = ShopOnline::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $parent_id);
            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *增加页面
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('Backend.admin.shoponline.create');
    }
    /**
     * @param Request $request
     * @return mixed
     * 增加
     */
    public function store(Request $request){
            $result = ['status' => false, 'message' => '增加失败!'];
            $ShopOnline = new ShopOnline();
            $ShopOnline->store_name = $request->get('store_name','');
            $ShopOnline->address = $request->get('address','');
            $ShopOnline->sales_volume = $request->get('sales_volume','');
            $ShopOnline->online_sales = $request->get('online_sales','');
            $res = $ShopOnline->save();
            if($res){
                $result = ['status' => true, 'message' => '增加成功!'];
            }
        return response()->json($result);
    }
    /**
     * @param Request $request
     * @return mixed
     * 修改基础信息页面
     */
    public function update(Request $request){
        $_id = $request->get('_id',0);
        $result = shoponline::find($_id);
        return view('Backend.admin.shoponline.update', compact('result'));
    }
    /**
     * @param Request $request
     * @return mixed
     * 修改基础信息保存功能
     */
    public function update_save(Request $request){
        $result = ['status' => false, 'message' => '修改失败!'];
        $_id = $request->get('_id');
        $ShopOnline = ShopOnline::find($_id);
        $ShopOnline->store_name = $request->get('store_name','');
        $ShopOnline->address = $request->get('address','');
        $ShopOnline->sales_volume = $request->get('sales_volume','');
        $ShopOnline->online_sales = $request->get('online_sales','');
        $res = $ShopOnline->save();
        if($res){
            $result = ['status' => true, 'message' => '修改成功!'];
        }
        return response()->json($result);
    }
    public function del(Request $request)
    {
        $id = $request->get('_id');
        ShopOnline::destroy($id);
        return redirect('admin/shoponline/index');
    }

}
