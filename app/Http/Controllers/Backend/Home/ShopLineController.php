<?php

namespace App\Http\Controllers\Backend\Home;

use App\Store\ShopLine;
use App\Models\Area;
use App\Models\Format;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class ShopLineController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.shopline.index', compact('parent_id'));
    }
    /**
     * Display a listing of the resource.
     *获取数据
     * @return \Illuminate\Http\Response
     */
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
            $countData = ShopLine::countNumber();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = ShopLine::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $parent_id);
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
        $area = Area::where('parent_id',0)->get();
        $business_type = $this->business_type();
        return view('Backend.admin.shopline.create',compact('area','business_type'));
    }
    /**
     * Show the form for creating a new resource.
     *房屋类型
     *
     */
    public function business_type()
    {
       $data = Format::where('status',1)->get();
       return $data;
    }


    /**
     * @param Request $request
     * @return mixed
     * 增加
     */
    public function store(Request $request){
            $result = ['status' => false, 'message' => '增加失败!'];
            $ShopLine = new ShopLine();
            //地区
            $ShopLine->province = $request->get('province',0);
            $ShopLine->city = $request->get('city',0);
            $ShopLine->county = $request->get('county',0);
            $ShopLine->owner_name = $request->get('owner_name');
            $ShopLine->owner_tel = $request->get('owner_tel');
            $ShopLine->location = $request->get('location');
            $ShopLine->business_type = $request->get('business_type');
            $ShopLine->total_area = $request->get('total_area');
            $ShopLine->useage_area = $request->get('useage_area');
            $ShopLine->floor_level = $request->get('floor_level');
            $ShopLine->width = $request->get('width');
            $ShopLine->depth = $request->get('depth');
            $ShopLine->floor_height = $request->get('floor_height');
            $ShopLine->leasing_type = $request->get('leasing_type');
            $ShopLine->status = $request->get('status');
            $ShopLine->rent = $request->get('rent');
            $ShopLine->progressive_rate = $request->get('progressive_rate');
            $ShopLine->payment_type = $request->get('payment_type');
            $ShopLine->deposit = $request->get('deposit');
            $ShopLine->current_duration = $request->get('current_duration');
            $ShopLine->remian_duration = $request->get('remian_duration');
            $ShopLine->max_duration = $request->get('max_duration');
            $ShopLine->contact_status = $request->get('contact_status');
            $ShopLine->photo = $request->get('image');
            $ShopLine->longitude = $request->get('longitude');
            $ShopLine->latitude = $request->get('latitude');
            $res = $ShopLine->save();
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
        $area = Area::where('parent_id',0)->get();
        $business_type = $this->business_type();
        $parent_id = $request->get('parent_id', 0);
        $_id = $request->get('_id',0);
        $result = shopline::find($_id);
        if($result->province){
            $city = Area::where('parent_id',$result->province)->get();
        }
        $county = Area::where('parent_id',$result->city)->get();
        return view('Backend.admin.shopline.update', compact('parent_id', 'result','area','business_type','city','county'));
    }
    /**
     * @param Request $request
     * @return mixed
     * 修改基础信息保存功能
     */
    public function update_save(Request $request){
        $result = ['status' => false, 'message' => '修改失败!'];
        $_id = $request->get('_id');
        $ShopLine = ShopLine::find($_id);
        $ShopLine->province = $request->get('province',0);
        $ShopLine->city = $request->get('city',0);
        $ShopLine->county = $request->get('county',0);
        $ShopLine->owner_name = $request->get('owner_name');
        $ShopLine->owner_tel = $request->get('owner_tel');
        $ShopLine->location = $request->get('location');
        $ShopLine->business_type = $request->get('business_type');
        $ShopLine->total_area = $request->get('total_area');
        $ShopLine->useage_area = $request->get('useage_area');
        $ShopLine->floor_level = $request->get('floor_level');
        $ShopLine->width = $request->get('width');
        $ShopLine->depth = $request->get('depth');
        $ShopLine->floor_height = $request->get('floor_height');
        $ShopLine->leasing_type = $request->get('leasing_type');
        $ShopLine->status = $request->get('status');
        $ShopLine->rent = $request->get('rent');
        $ShopLine->progressive_rate = $request->get('progressive_rate');
        $ShopLine->payment_type = $request->get('payment_type');
        $ShopLine->deposit = $request->get('deposit');
        $ShopLine->current_duration = $request->get('current_duration');
        $ShopLine->remian_duration = $request->get('remian_duration');
        $ShopLine->max_duration = $request->get('max_duration');
        $ShopLine->contact_status = $request->get('contact_status');
        $ShopLine->photo = $request->get('image');
        $ShopLine->longitude = $request->get('longitude');
        $ShopLine->latitude = $request->get('latitude');
        $res = $ShopLine->save();
        if($res){
            $result = ['status' => true, 'message' => '修改成功!'];
        }
        return response()->json($result);
    }
    /**
     * @param Request $request
     * @return mixed
     * 可经营液态
     */
    public function  format(){
        $data = array(
            'format_restaurant'=>'酒楼餐饮',
            'format_cloth'=>'服饰鞋包',
            'format_leisure'=>'休闲娱乐',
            'format_beauty_and_hair_salon'=>'美容美发',
            'format_life_service'=>'生活服务',
            'format_market'=>'百货超市',
            'format_furniture_decoration'=>'家具建材',
            'format_telecom'=>'电器通讯',
            'format_vehicle_service'=>'汽修美容',
            'format_medical'=>'医药保健',
            'format_education'=>'教育培训',
            'format_hotels'=>'旅馆宾馆',
            'format_other_business_type'=>'其它业态'
        );
        return $data;
    }
    /**
     * @param Request $request
     * @return mixed
     * 可经营液态
     */
    public function  engineering(){
        $data = array(
            'engineering_water_supply'=>'上水',
            'engineering_draignage'=>'下水',
            'engineering_380_volt'=>'380伏',
            'engineering_gas_tube'=>'煤气罐',
            'engineering_smoke_tube'=>'烟管道',
            'engineering_sewage'=>'排污管道',
            'engineering_parking_lot'=>'停车位',
            'engineering_nature_gas'=>'天然气',
            'engineering_outside_area'=>'外摆区',
            'engineering_falme'=>'可明火',
            'engineering_license_approval'=>'可办照',
        );
        return $data;
    }
    /**
     * @param Request $request
     * @return mixed
     * 商铺人流信息页面
     */
    public function stream(Request $request){
        $_id = $request->get('_id',0);
        $result = shopline::find($_id);
        $format = $this->format();
        $engineering = $this->engineering();
        return view('Backend.admin.shopline.stream', compact( 'result','area','format','engineering'));
    }
    /**
     * @param Request $request
     * @return mixed
     * 修改基础信息保存功能
     */
    public function stream_save(Request $request){
        $result = ['status' => false, 'message' => '修改失败!'];
        $_id = $request->get('_id');
        $ShopLine = ShopLine::where('_id',$_id)->first();

        $ShopLine->format_restaurant = $request->get('format_restaurant',0);
        $ShopLine->format_cloth = $request->get('format_cloth',0);
        $ShopLine->format_leisure = $request->get('format_leisure',0);
        $ShopLine->format_beauty_and_hair_salon = $request->get('format_beauty_and_hair_salon',0);
        $ShopLine->format_life_service = $request->get('format_life_service',0);
        $ShopLine->format_market = $request->get('format_market',0);
        $ShopLine->format_furniture_decoration = $request->get('format_furniture_decoration',0);
        $ShopLine->format_telecom = $request->get('format_telecom',0);
        $ShopLine->format_vehicle_service = $request->get('format_vehicle_service',0);
        $ShopLine->format_medical = $request->get('format_medical',0);
        $ShopLine->format_education = $request->get('format_education',0);
        $ShopLine->format_hotels = $request->get('format_hotels',0);
        $ShopLine->format_other_business_type = $request->get('format_other_business_type',0);

        $ShopLine->engineering_water_supply = $request->get('engineering_water_supply',0);
        $ShopLine->engineering_draignage = $request->get('engineering_draignage',0);
        $ShopLine->engineering_380_volt = $request->get('engineering_380_volt',0);
        $ShopLine->engineering_gas_tube = $request->get('engineering_gas_tube',0);
        $ShopLine->engineering_smoke_tube = $request->get('engineering_smoke_tube',0);
        $ShopLine->engineering_sewage = $request->get('engineering_sewage',0);
        $ShopLine->engineering_parking_lot = $request->get('engineering_parking_lot',0);
        $ShopLine->engineering_nature_gas = $request->get('engineering_nature_gas',0);
        $ShopLine->engineering_outside_area = $request->get('engineering_outside_area',0);
        $ShopLine->engineering_falme = $request->get('engineering_falme',0);
        $ShopLine->engineering_license_approval = $request->get('engineering_license_approval',0);
       /* dd($request->get('restaurant',0));*/
        $ShopLine->pct = $request->get('pct');
        $ShopLine->eat_here = $request->get('eat_here');
        $ShopLine->takeout = $request->get('takeout');
        $ShopLine->revenue = $request->get('revenue');
        $ShopLine->customer_type = $request->get('customer_type');
        $ShopLine->busy_time = $request->get('busy_time');
        $ShopLine->advantage = $request->get('advantage');
        $res = $ShopLine->save();
        if($res){
            $result = ['status' => true, 'message' => '修改成功!'];
        }
        return response()->json($result);
    }




    public function del(Request $request)
    {
        $id = $request->get('_id');
        ShopLine::destroy($id);
        return redirect('admin/shopline/index');
    }

}
