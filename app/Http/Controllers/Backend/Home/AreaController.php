<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddArea;
use App\Models\Area;
use App\Library\Categores;
use App\Store\AreaStore;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class AreaController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.area.index', compact('parent_id'));
    }

    public function indexData(Request $request)
    {
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
            $countData = Area::countNumber($parent_id,0);
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = Area::getAllData($parent_id, $columns[$order[0]['column']]['data'], $order[0]['dir']);
            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //增加和修改页面
    public function create(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        $parent_name = Area::find($parent_id);
        return view('Backend.admin.area.create', compact('parent_id','parent_name'));
    }

    //修改页
    public function update(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        $result = area::where('id', $request->get('id', 0))->first();
        return view('Backend.admin.area.update', compact('parent_id', 'result'));
    }

    //增加和修改
    public function save(Request $request)
    {
        if ($request->get('id', 0)) {
            //修改
            $parent_id = $request->get('parent_id');
            $result = ['status' => false, 'message' => '修改失败'];
            $data['name'] = $request->get('name');
            $data['show'] = $request->get('show');
            $data['view_order'] = $request->get('view_order');
            $data['shorthand'] = strtoupper($request->get('shorthand'));
            $data['parent_id'] = $parent_id;
            $data['description'] = $request->get('description');
            $model = new Area();
            $res = Area::updateData($model, $request->get('id'), $data);
            if ($res) {
                $result = ['status' => true, 'message' => '修改成功!', 'url' => url('admin/area/index?parent_id=' . $parent_id)];
            }
        } else {
            //增加
            $result = ['status' => false, 'message' => '增加失败'];
            $parent_id = $request->get('parent_id');
            $area = new area();
            $area->name = $request->get('name');
            $area->view_order = $request->get('view_order');
            $data['shorthand'] = strtoupper($request->get('shorthand'));
            $area->show = $request->get('show');
            $area->parent_id = $parent_id;
            $area->description = $request->get('description');
            $res = $area->save();
            if ($res) {
                $result = ['status' => true, 'message' => '增加成功!', 'url' => url('admin/area/index?parent_id=' . $parent_id)];
            }
        }
        return response()->json($result);
    }

    public function del(Request $request)
    {
        $id = $request->get('id');
        $res = Area::where('parent_id',$id)->first();
        if($res){
            return redirect('admin/area/index')->with('success','删除失败有子类');
        }else{
            Area::destroy($id);
            return redirect('admin/area/index')->with('success','删除成功');
        }
    }
    /**
     * Display a listing of the resource.
     *市区展示
     * @return \Illuminate\Http\Response
     */
    public function city_index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        $cat_id = $request->get('cat_id',0); //父级ID
        $cat_name = Area::find($cat_id);
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
            $map = $request->get('cat_id'); //父级ID
            if($parent_id){
                $countData = Area::where('parent_id',$map)->where('name','like','%'.$parent_id.'%')->count();
            }else{
                $countData = Area::where('parent_id',$map)->count();
            }
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = Area::allCity($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $parent_id,$map);
            return response()->json($data);
        }
        return view('Backend.admin.area.city_index', compact('parent_id','cat_id','cat_name'));
    }
    public function county_index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        $cat_id = $request->get('cat_id',0); //父级ID
        $cat_name = Area::find($cat_id);
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
            $map = $request->get('cat_id'); //父级ID
            if($parent_id){
                $countData = Area::where('parent_id',$map)->where('name','like','%'.$parent_id.'%')->count();
            }else{
                $countData = Area::where('parent_id',$map)->count();
            }
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = Area::allCity($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $parent_id,$map);
            return response()->json($data);
        }
        return view('Backend.admin.area.county_index', compact('parent_id','cat_id','cat_name'));
    }

}
