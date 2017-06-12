<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddCategory;
use App\Models\Admin;
use App\Models\Catalog;
use App\Models\Roles;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Library\Categores;
use App\Http\Requests;
use App\Http\Controllers\BackendController;

class CatalogController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.catalog.index', compact('parent_id'));
    }

    public function indexData(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('search');//获取前台传过来的过滤条件
            $parent_id = $request->get('parent_id');//获取前台传过来的过滤条件
          /*  $start = $request->get('start', '0');
            $length = $request->get('length', '20');*/
            $start = 0;
            $length = 100;
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');
            $key = $search['value'];
            $countData = Catalog::countNumber();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = Catalog::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $key);
            $data['data']= $this->cateToOne($data['data']);
            return response()->json($data);
        }
    }
    public function cateToOne($cate, $html='├─', $pid=0, $level=0){
        $arr = array();
        foreach($cate as $k =>$v){
            if($v['parent_id'] == $pid){
                $v['level'] = $level + 1;
                $v['html'] = str_repeat($html, $level);
                $arr[] = $v;
                unset($cate[$k]);
                $arr = array_merge($arr, $this->cateToOne($cate, $html, $v['id'], $level+1));
            }
        }
        return $arr;
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
        return view('Backend.admin.catalog.create', compact('parent_id', 'category','data_menu'));
    }
    public function getTestList ()
    {
        return $this->where( array( 'state'=> 0 ))->order(  'path asc, sort asc' )->select();
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
            $question = new Catalog();
            $question->name = $request->get('name');
            $question->parent_id = $request->get('parent_id');
            $question->model = $request->get('model');
            $question->sort = $request->get('sort');
            $question->icon = $request->get('icon');
            $question->status = $request->get('status')?$request->get('status'):'0';
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
        $result = Catalog::getId($id);
        $menu = Catalog::orderBy('path','sort')->get()->toArray();
        $categores = new Categores();
        $data_menu= $categores->cateToOne($menu);
        return view('Backend.admin.catalog.update', compact('parent_id', 'result','data_menu'));
    }
    //修改功能
    public function update_save(Request $request){
        $result = ['status' => false, 'message' => ''];
        $question = Catalog::where('id', $request->get('id'))->first();

        if ($question) {
            $question->name = $request->get('name');
            $question->parent_id = $request->get('parent_id');
            $question->model = $request->get('model');
            $question->sort = $request->get('sort');
            $question->icon = $request->get('icon');
            $question->status = $request->get('status')?$request->get('status'):'0';
            if ($question->save()) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
        }
        return response()->json($result);
    }
    //修改密码页面
    public function edit(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        $id =  $request->get('id');
        $result = Admin::getId($id);
        return view('Backend.admin.admin.edit', compact('parent_id', 'result'));
    }
    //修改密码
    public function pass(Request $request){
        $result = ['status' => false, 'message' => '保存失败!'];
        $id=$request->get('id');
        $pass=$request->get('password');
        $res = Admin::where('id',$id)->update(['password'=>bcrypt($pass)]);

        if($res){
                $result = ['status' => true, 'message' => '保存成功!','id'=>$id];
        }
        return response()->json($result);
    }
    //删除
    public function del(Request $request){
        $id = $request->get('id');
        $pid = Catalog::where('parent_id',$id)->first();
        if($pid){
            return  redirect('admin/catalog/index')->with('success','删除失败,请您先删除子级');
        }else{
            $res = Catalog::destroy($id);
            return  redirect('admin/catalog/index')->with('success','删除成功');
        }

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
