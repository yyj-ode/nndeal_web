<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddCategory;
use App\Models\Admin;
use App\Models\PermissionRole;
use App\Models\Roles;
use App\Models\Catalog;
use App\Models\Permission;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Library\Categores;
use App\Http\Requests;
use App\Http\Controllers\BackendController;

class RolesController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.roles.index', compact('parent_id'));
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
            $countData = Roles::countNumber();

            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;

            $data['data'] = Roles::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $key);

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
        $parent_id = $request->get('parent_id', 0);
        $category = Category::getByParentId($parent_id);

        $menu = Catalog::orderBy('parent_id','sort')->get()->toArray();
        $categores = new Categores();
        $data_menu= $categores->cateToOne($menu);

        return view('Backend.admin.roles.create', compact('parent_id', 'category','data_menu'));
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
            $question = new Roles();
            $question->name = $request->get('name');
            $question->display_name = $request->get('display_name');
            $question->description = $request->get('description');

            if ($question->save()) {
                // dispatch(new AddCategory($question->id));
                $result = ['status' => true, 'message' => '保存成功!'];
            }
        return response()->json($result);
    }
    //修改页面
    public function update(Request $request){
        $parent_id = $request->get('parent_id', 0);
        $id =  $request->get('id');
        $result = Roles::getId($id);

        $menu = Catalog::orderBy('parent_id','sort')->get()->toArray();
        return view('Backend.admin.roles.update', compact('parent_id', 'result','data_menu'));
    }
    //修改功能
    public function update_save(Request $request){
        $result = ['status' => false, 'message' => ''];
        $question = Roles::where('id', $request->get('id'))->first();

        if ($question) {
            $question->name = $request->get('name');
            $question->description = $request->get('description');
            $question->display_name = $request->get('display_name');

            if ($question->save()) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
        }
        return response()->json($result);
    }
    //权限增加页面
    public function permissions(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        $id =  $request->get('id');
        $result = Roles::getId($id);
        $permission=Permission::orderBy('parent_id')->get(); //全部权限
        $group=PermissionRole::where('admin_role_id',$id)->get();

        return view('Backend.admin.roles.permissions', compact('parent_id', 'result','permission','group'));
    }
    //权限修改功能
    public function permissionsSave(Request $request){
                $group = new PermissionRole();
                $id= $request->get('id');
                $roles_get=$request->get('roles',array()); //选择的权限
                $roles_data = Permission::get(); //全部的权限
                foreach ($roles_data as $k=>$v){
                    if(in_array($v['id'],$roles_get)){
                        $group_res = PermissionRole::where([['admin_role_id',$id],['admin_permission_id',$v['id']]])->first();
                        if(!$group_res){
                            $group_data['admin_role_id']=$id;
                            $group_data['admin_permission_id']=$v['id'];
                            $group->insert($group_data);
                        }
                    }else{
                        PermissionRole::where([['admin_role_id',$id],['admin_permission_id',$v['id']]])->delete();
                    }
                }
        $result = ['status' => true, 'message' => '保存成功!','id'=>$id];
        return response()->json($result);
    }
    //删除
    public function del(Request $request){
        $id = $request->get('id');
        $res = Roles::where('id',$id)->delete();
        return  redirect('admin/roles/index');
    }
}
