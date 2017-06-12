<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddAuthentication;
use App\Models\Authentication;
use App\Library\Categores;
use App\Store\AuthenticationStore;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;

class AuthenticationController extends BackendController
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
            $countData = Authentication::countNumber($parent_id);
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $status = $this->status();
            $data['data'] = Authentication::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $parent_id);
            foreach ($data['data'] as $k=>$v){
                $data['data'][$k]['users_id'] = $v['users']['mobile'];
                $data['data'][$k]['status'] = $status[$v['status']];
            }
            return response()->json($data);
        }
        return view('Backend.admin.authentication.index', compact('parent_id'));
    }

    public function status(){
        $status[0] = '待审核';
        $status[1] = '审核通过';
        $status[2] = '审核未通过';
        return $status;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //增加页面
    public function create(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.authentication.create', compact('parent_id'));
    }
    //修改页
    public function update(Request $request){
        $parent_id = $request->get('parent_id', 0);
        $id = $request->get('id',0);
        $result = authentication::getFirstData($id);
        return view('Backend.admin.authentication.update', compact('parent_id', 'result'));
    }
    //增加和修改
    public function save(Request $request)
    {
        if($request->get('id',0)){
            //修改
            $result = ['status' => false, 'message' => '修改失败'];
            $data['status'] = $request->get('status');
            $data['image'] = $request->get('image');
            $model = new Authentication();
            $res=Authentication::updateData($model,$request->get('id'),$data);
            if($res){
                $result = ['status' => true, 'message' => '修改成功!'];
            }
        }else{
            //增加
            $result = ['status' => false, 'message' => '增加失败'];
            $authentication = new authentication();
            $authentication->name = $request->get('name');
            $authentication->show = $request->get('show');
            $authentication->parent_id = $request->get('parent_id');
            $authentication->description = $request->get('description');
            $res = $authentication->save();
            if($res){
                $result = ['status' => true, 'message' => '增加成功!'];
            }
        }
        return response()->json($result);
    }
    public function del(Request $request)
    {
        $id = $request->get('id');
        Authentication::destroy($id);
        return redirect('admin/authentication/index');
    }

}
