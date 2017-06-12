<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\Area;
use App\Models\ShopSurrounding;
use App\Models\Power;
use App\Models\Format;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Http\Controllers\BackendController;

class ShopSurroundingController extends BackendController
{

    /**
     * 显示周边商铺首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('Backend.admin.shopsurrounding.index');
    }

    /**
     * 获取首页信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexData(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->get('start', '0');
            $length = $request->get('length', '10');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');
            $countData = ShopSurrounding::count();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = ShopSurrounding::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir']);
            foreach($data['data'] as $key => $value){
                $data['data'][$key]['categories'] = $value['format']['name'];
                $data['data'][$key]['province'] = $value['province1']['name'];
                $data['data'][$key]['city'] = $value['city1']['name'];
                $data['data'][$key]['county'] = $value['county1']['name'];
            }
            return response()->json($data);
        }
    }

    /**
     * 检查省份信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request)
    {
        $id = $request->get('id');
        $data = Area::where('parent_id',$id)->get();
        return response()->json($data);
    }

    /**
     * 新建周边商铺
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $area = Area::where('parent_id',0)->get();
        $format = Format::get();
        return view('Backend.admin.shopsurrounding.create',compact('area','format'));
    }

    /**
     * 存储周边商铺
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $ShopSurrounding = new ShopSurrounding();
        $data['province'] = $request->get('province',null);
        $data['city'] = $request->get('city',null);
        $data['county'] = $request->get('county',null);
        $data['address'] = $request->get('address',null);
        $data['categories'] = $request->get('categories',null);
        $data['price'] = $request->get('price',null);
        $data['longitude'] = $request->get('longitude',null);
        $data['latitude'] = $request->get('latitude',null);
        $res= $ShopSurrounding->addData($ShopSurrounding,$data);
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
    }

    /**
     * 更新周边商铺
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request){
        $format = Format::get();
        $area = Area::where('parent_id',0)->get();
        $parent_id = $request->get('parent_id', 0);
        $_id = $request->get('_id',0);
        $result = shopsurrounding::find($_id);
        if($result->province){
            $city = Area::where('parent_id',$result->province)->get();
        }
        $county = Area::where('parent_id',$result->city)->get();
        return view('Backend.admin.shopsurrounding.edit', compact('parent_id', 'result','area','city','county','format'));
    }

    /**
     * 保存周边商铺修改
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doupdate(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $id = $request->get('_id',null);
        $ShopSurrounding = new ShopSurrounding();
        $data['province'] = $request->get('province',null);
        $data['city'] = $request->get('city',null);
        $data['county'] = $request->get('county',null);
        $data['address'] = $request->get('address',null);
        $data['categories'] = $request->get('categories',null);
        $data['price'] = $request->get('price',null);
        $data['longitude'] = $request->get('longitude',null);
        $data['latitude'] = $request->get('latitude',null);
        $res = ShopSurrounding::updateData($ShopSurrounding, $id, $data);
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
    }

    /**
     * 删除周边商铺
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function del(Request $request)
    {
        $id = $request->get('_id',null);
        $res= ShopSurrounding::destroy($id);
        if ($res) {
            return redirect('admin/shopsurrounding/index');
        }else{
            $result = ['status' => true, 'message' => '删除失败!'];
            return response()->json($result);
        }

    }

}
