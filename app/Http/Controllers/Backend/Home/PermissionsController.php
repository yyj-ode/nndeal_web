<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddCategory;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Library\Categores;
use App\Http\Requests;
use App\Http\Controllers\BackendController;

class PermissionsController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.permissions.index', compact('parent_id'));
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
            $countData = Permission::countNumber();

            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;

            $data['data'] = Permission::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $key);


          //  dd($data['data']);
            foreach ($data['data'] as $k=>$v){
                $v['parent_id'] = $v['catalog']['name'];
            }
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

        return view('Backend.admin.permissions.create', compact('parent_id', 'category','data_menu'));
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
            $question = new Permission();
            $question->label = $request->get('label');
            $question->name = strtolower($request->get('name'));
            $question->parent_id = $request->get('cat_id');

            $question->prefix = $request->get('prefix');
            $question->controllers = $request->get('controllers');
            $question->action = $request->get('action');
            $question->show = $request->get('show','0');


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
        $result = Permission::getId($id);

        $menu = Catalog::orderBy('parent_id','sort')->get()->toArray();
        $categores = new Categores();
        $data_menu= $categores->cateToOne($menu);

        return view('Backend.admin.permissions.update', compact('parent_id', 'result','data_menu'));
    }
    //修改功能
    public function update_save(Request $request){
        $result = ['status' => false, 'message' => ''];
        $question = Permission::where('id', $request->get('id'))->first();
        if ($question) {
            $question->label = $request->get('label');
            $question->name = $request->get('name');
            $question->parent_id = $request->get('cat_id');
            $question->prefix = $request->get('prefix');
            $question->controllers = $request->get('controllers');
            $question->action = $request->get('action');
            $question->show = $request->get('show','0');
            $question->description = $request->get('description');

            if ($question->save()) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
        }
        return response()->json($result);
    }

    //删除
    public function del(Request $request){
        $id = $request->get('id');
        Permission::where('id',$id)->delete();
        return  redirect('admin/permissions/index');
    }

}
