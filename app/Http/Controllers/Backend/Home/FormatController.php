<?php

namespace App\Http\Controllers\Backend\Home;

use App\Store\Format;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class FormatController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.format.index', compact('parent_id'));
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
            $countData = Format::countNumber($parent_id);
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = Format::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $parent_id);

            $status[1] = '显示';
            $status[0] = '隐藏';
            foreach ($data['data'] as $k=>$v){
                $data['data'][$k]['status'] = $status[$v['status']];
            }
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
        return view('Backend.admin.format.create');
    }
    /**
     * @param Request $request
     * @return mixed
     * 增加
     */
    public function store(Request $request){
            $result = ['status' => false, 'message' => '增加失败!'];
            $Format = new Format();
            $Format->name = $request->get('name');
            $Format->status = $request->get('status');
            $Format->sort = $request->get('sort');
            $res = $Format->save();
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
        $result = format::find($_id);
        return view('Backend.admin.format.update', compact('result'));
    }
    /**
     * @param Request $request
     * @return mixed
     * 修改基础信息保存功能
     */
    public function update_save(Request $request){
        $result = ['status' => false, 'message' => '修改失败!'];
        $id = $request->get('_id');
        $Format = Format::find($id);
        $Format->name = $request->get('name');
        $Format->status = $request->get('status');
        $Format->sort = $request->get('sort');
        $res = $Format->save();
        if($res){
            $result = ['status' => true, 'message' => '修改成功!'];
        }
        return response()->json($result);
    }
    /*public function del(Request $request)
    {
        $id = $request->get('id');
        Format::destroy($id);
        return redirect('admin/format/index');
    }*/

}
