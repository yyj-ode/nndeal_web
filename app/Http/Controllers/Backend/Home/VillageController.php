<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\Area;
use App\Models\Village;
use App\Models\Power;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Http\Controllers\BackendController;

class VillageController extends BackendController
{
    /**
     * 显示首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('Backend.admin.village.index');
    }

    /**
     * 获取首页数据
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
            $countData = Village::count();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = Village::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir']);
            return response()->json($data);
        }
    }

    /**
     * 辅助获取省份信息
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
     * 添加新小区信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('Backend.admin.village.create');
    }

    /**
     * 储存小区信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $Village = new Village();
        $data['longitude'] = $request->get('longitude',null);
        $data['latitude'] = $request->get('latitude',null);
        $data['community_name'] = $request->get('community_name',null);
        $data['community_adress'] = $request->get('community_adress',null);
        $data['building_age'] = $request->get('building_age',null);
        $data['building_category'] = $request->get('building_category',null);
        $data['property_management_fee'] = $request->get('property_management_fee',null);
        $data['property_management_company'] = $request->get('property_management_company',null);
        $data['developer'] = $request->get('developer',null);
        $data['total_building_number'] = $request->get('total_building_number',null);
        $data['total_apartment_number'] = $request->get('total_apartment_number',null);
        $data['price'] = $request->get('price',null);
        $res= $Village->addData($Village,$data);
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
    }


    /**
     * 编辑小区信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request){
        $_id = $request->get('_id',0);
        $result = village::find($_id);
        return view('Backend.admin.village.edit', compact('result','_id'));
    }

    /**
     * 显示小区全部信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request){
        $_id = $request->get('_id',0);
        $result = village::find($_id);
        return view('Backend.admin.village.detail', compact('result','_id'));
    }

    /**
     * 保存小区信息修改
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doupdate(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $id = $request->get('_id',null);
        $Village = new Village();
        $data['longitude'] = $request->get('longitude',null);
        $data['latitude'] = $request->get('latitude',null);
        $data['community_name'] = $request->get('community_name',null);
        $data['community_adress'] = $request->get('community_adress',null);
        $data['building_age'] = $request->get('building_age',null);
        $data['building_category'] = $request->get('building_category',null);
        $data['property_management_fee'] = $request->get('property_management_fee',null);
        $data['property_management_company'] = $request->get('property_management_company',null);
        $data['developer'] = $request->get('developer',null);
        $data['total_building_number'] = $request->get('total_building_number',null);
        $data['total_apartment_number'] = $request->get('total_apartment_number',null);
        $data['price'] = $request->get('price',null);
        $res = Village::updateData($Village, $id, $data);
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
    }

    /**
     * 删除小区信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function del(Request $request)
    {
        $id = $request->get('_id',null);
        $res= Village::destroy($id);
        if ($res) {
            return redirect('admin/village/index');
        }else{
            $result = ['status' => true, 'message' => '删除失败!'];
            return response()->json($result);
        }

    }

}
