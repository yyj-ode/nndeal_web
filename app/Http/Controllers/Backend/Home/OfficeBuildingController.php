<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\OfficeBuilding;
use App\Models\Power;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Http\Controllers\BackendController;

class OfficeBuildingController extends BackendController
{

    public function index(Request $request)
    {
        return view('Backend.admin.officebuilding.index');
    }

    public function indexData(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->get('start', '0');
            $length = $request->get('length', '10');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');
            $countData = OfficeBuilding::count();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = OfficeBuilding::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir']);
//            dd($data);
            return response()->json($data);
        }
    }

    public function create(Request $request)
    {
        return view('Backend.admin.officebuilding.create');
    }

    public function store(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $OfficeBuilding = new OfficeBuilding();
        $data['longitude'] = $request->get('longitude',null);
        $data['latitude'] = $request->get('latitude',null);
        $data['office_name'] = $request->get('office_name',null);
        $data['office_address'] = $request->get('office_address',null);
        $data['company_categories'] = $request->get('company_categories',null);
        $data['rent_rate'] = $request->get('rent_rate',null);
        $res= $OfficeBuilding->addData($OfficeBuilding,$data);
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
    }


    public function update(Request $request){
        $_id = $request->get('_id',0);
        $result = officebuilding::find($_id);
        return view('Backend.admin.officebuilding.edit', compact('result','_id'));
    }

    public function detail(Request $request){
        $_id = $request->get('_id',0);
        $result = officebuilding::find($_id);
        return view('Backend.admin.officebuilding.detail', compact('result','_id'));
    }

    public function doupdate(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $id = $request->get('_id',null);
        $OfficeBuilding = new OfficeBuilding();
        $data['longitude'] = $request->get('longitude',null);
        $data['latitude'] = $request->get('latitude',null);
        $data['office_name'] = $request->get('office_name',null);
        $data['office_address'] = $request->get('office_address',null);
        $data['company_categories'] = $request->get('company_categories',null);
        $data['rent_rate'] = $request->get('rent_rate',null);
        $res = OfficeBuilding::updateData($OfficeBuilding, $id, $data);
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
    }

    public function del(Request $request)
    {
        $id = $request->get('_id',null);
        $res= OfficeBuilding::destroy($id);
        if ($res) {
            return redirect('admin/officebuilding/index');
        }else{
            $result = ['status' => true, 'message' => '删除失败!'];
            return response()->json($result);
        }

    }

}
