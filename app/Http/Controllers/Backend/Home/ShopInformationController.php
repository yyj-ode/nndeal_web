<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\Area;
use App\Models\ShopInformation;
use App\Models\Power;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Http\Controllers\BackendController;

class ShopInformationController extends BackendController
{
    /**
     * 显示商铺信息首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('Backend.admin.shopinformation.index');
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
            $countData = ShopInformation::count();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = ShopInformation::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir']);
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
     * 新建商铺信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $area = Area::where('parent_id',0)->get();
        return view('Backend.admin.shopinformation.create',compact('area'));
    }

    /**
     * 存储商铺信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $ShopInformation = new ShopInformation();
        $ShopInformation->longitude = $request->get('longitude',null);
        $ShopInformation->latitude = $request->get('latitude',null);
        $ShopInformation->province = $request->get('province',null);
        $ShopInformation->city = $request->get('city',null);
        $ShopInformation->county = $request->get('county',null);
        $ShopInformation->adress = $request->get('adress',null);
        $ShopInformation->building_category = $request->get('building_category',null);
        $ShopInformation->floor_level = $request->get('floor_level',null);
        $ShopInformation->area = $request->get('area',null);
        $ShopInformation->floor_height = $request->get('floor_height',null);
        $ShopInformation->door_width = $request->get('door_width',null);
        $ShopInformation->depth = $request->get('depth',null);
        $ShopInformation->current_status = $request->get('current_status',null);
        $ShopInformation->license = $request->get('license',null);
        $ShopInformation->water_supply_and_drainage = $request->get('water_supply_and_drainage',null);
        $ShopInformation->electricity = $request->get('electricity',null);
        $ShopInformation->gas_tube = $request->get('gas_tube',null);
        $ShopInformation->smoke_tube = $request->get('smoke_tube',null);
        $ShopInformation->sewage = $request->get('sewage',null);
        $ShopInformation->flame = $request->get('flame',null);
        $ShopInformation->leasing_duration = $request->get('leasing_duration',null);
        $ShopInformation->payment_type = $request->get('payment_type',null);
        $ShopInformation->leasing_payment = $request->get('leasing_payment',null);
        $ShopInformation->rent = $request->get('rent',null);
        $ShopInformation->progressive_rate = $request->get('progressive_rate',null);
        $ShopInformation->photo = $request->get('image',null);

        $res= $ShopInformation->save();
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
    }

    /**
     * 更新商铺信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $area = Area::where('parent_id',0)->get();
        $parent_id = $request->get('parent_id', 0);
        $_id = $request->get('_id',0);
        $result = shopinformation::find($_id);
        if($result->province){
            $city = Area::where('parent_id',$result->province)->get();
        }
        $county = Area::where('parent_id',$result->city)->get();
        return view('Backend.admin.shopinformation.edit', compact('parent_id', 'result','area','city','county'));
    }

    /**
     * 显示商铺信息详情
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $area = Area::where('parent_id',0)->get();
        $parent_id = $request->get('parent_id', 0);
        $_id = $request->get('_id',0);
        $result = shopinformation::find($_id);
        if($result->province){
            $city = Area::where('parent_id',$result->province)->get();
        }
        $county = Area::where('parent_id',$result->city)->get();
        return view('Backend.admin.shopinformation.detail', compact('parent_id', 'result','area','city','county'));
    }

    /**
     * 保存商铺信息修改
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doupdate(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $id = $request->get('_id',null);
        $ShopInformation = new ShopInformation();
        $data['longitude'] = $request->get('longitude',null);
        $data['latitude'] = $request->get('latitude',null);
        $data['province'] = $request->get('province',null);
        $data['city'] = $request->get('city',null);
        $data['county'] = $request->get('county',null);
        $data['adress'] = $request->get('adress',null);
        $data['building_category'] = $request->get('building_category',null);
        $data['floor_level'] = $request->get('floor_level',null);
        $data['area'] = $request->get('area',null);
        $data['floor_height'] = $request->get('floor_height',null);
        $data['door_width'] = $request->get('door_width',null);
        $data['depth'] = $request->get('depth',null);
        $data['current_status'] = $request->get('current_status',null);
        $data['license'] = $request->get('license',null);
        $data['water_supply_and_drainage'] = $request->get('water_supply_and_drainage',null);
        $data['electricity'] = $request->get('electricity',null);
        $data['gas_tube'] = $request->get('gas_tube',null);
        $data['smoke_tube'] = $request->get('smoke_tube',null);
        $data['sewage'] = $request->get('sewage',null);
        $data['flame'] = $request->get('flame',null);
        $data['leasing_duration'] = $request->get('leasing_duration',null);
        $data['payment_type'] = $request->get('payment_type',null);
        $data['leasing_payment'] = $request->get('leasing_payment',null);
        $data['rent'] = $request->get('rent',null);
        $data['progressive_rate'] = $request->get('progressive_rate',null);
        $data['photo'] = $request->get('image',null);
        $res = ShopInformation::updateData($ShopInformation, $id, $data);
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
    }

    /**
     * 删除商铺信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function del(Request $request)
    {
        $id = $request->get('_id',null);
        $res= ShopInformation::destroy($id);
        if ($res) {
            return redirect('admin/shopinformation/index');
        }else{
            $result = ['status' => true, 'message' => '删除失败!'];
            return response()->json($result);
        }
    }

}
