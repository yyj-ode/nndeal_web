<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddCategory;
use App\Models\Admin;
use App\Models\Category;
use App\Models\AdminRole;
use App\Models\AdminAdminRole;
use App\Models\AdminPermissionRole;
use App\Models\Roles;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use Log;
use App\Http\Requests;
use App\Http\Controllers\BackendController;

class AdminController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.admin.index', compact('parent_id'));
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

            $key = $search['value'];
            $countData = Admin::countNumber();

            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;

            $data['data'] = Admin::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $key);

            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $role = Roles::get();
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.admin.create', compact('parent_id',  'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    //增加入库
    public function store(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $res = Admin::getEmail($request->get('email'));
        if (!$res) {
            $question = new Admin();
            $question->name = $request->get('name');
            $question->password = bcrypt($request->get('password'));
            $question->email = $request->get('email');
            if ($question->save()) {
                $id = $question->id; //user_ID
                $group = new AdminAdminRole();
                $roles = $request->get('roles'); // 选择的角色
                foreach ($roles as $k => $v) {
                    $group_data[] = array('admin_role_id' => $v, 'admin_id' => $id);
                }
                $group->insert($group_data);
                // dispatch(new AddCategory($question->id));
                $result = ['status' => true, 'message' => '保存成功!'];
            }
        }
        return response()->json($result);
    }

    //修改页面
    public function update(Request $request)
    {
        $id = $request->get('id');
        $roles = Roles::get();
        $result = Admin::getId($id);
        $admin_role = AdminAdminRole::where('admin_id', $id)->get();

        return view('Backend.admin.admin.update', compact('result', 'roles', 'admin_role'));
    }

    /**
     * 修改功能
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSave(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败'];
        $id = $request->get('id');
        $admin = Admin::where('id', $id)->first();
        if ($admin) {
            $admin->name = $request->get('name');
            $group = new AdminAdminRole();
            if ($admin->save()) {
                $roles_get=$request->get('roles'); //选择的角色
                $roles_data = Roles::get(); //全部的角色
                foreach ($roles_data as $k=>$v){
                    if(in_array($v['id'],$roles_get)){
                        $group_res = AdminAdminRole::where([['admin_id',$id],['admin_role_id',$v['id']]])->first();
                        if(!$group_res){
                            $group_data['admin_id']=$id;
                            $group_data['admin_role_id']=$v['id'];
                            $group->insert($group_data);
                        }
                    }else{
                        AdminAdminRole::where([['admin_id',$id],['admin_role_id',$v['id']]])->delete();
                    }
                }
                $result = ['status' => true, 'message' => '保存成功!'];
            }
        }
        return response()->json($result);
    }

    //修改密码页面
    public function edit(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        $id = $request->get('id');
        $result = Admin::getId($id);
        return view('Backend.admin.admin.edit', compact('parent_id', 'result'));
    }

    //修改密码
    public function pass(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $id = $request->get('id');
        $pass = $request->get('password');
        $res = Admin::where('id', $id)->update(['password' => bcrypt($pass)]);

        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!', 'id' => $id];
        }
        return response()->json($result);
    }

    //删除
    public function del(Request $request)
    {
        $id = $request->get('id');
        $res = Admin::destroy($id);
        return redirect('admin/admin/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function captcha(Request $request)
    {
        $mobile = $request->get('mobile');
    }

    public function isMobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * 获取所有下一级数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function category(Request $request)
    {
        $id = $request->get('id');
        $data = CategoryStore::getByParentIds($id);
        return response()->json($data);
    }

    /**
     * 判断是不是最后栏目
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request)
    {
        $id = $request->get('id');
        $data = CategoryStore::checkByParentId($id);
        $result = ['status' => $data ? 1 : 2];
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
