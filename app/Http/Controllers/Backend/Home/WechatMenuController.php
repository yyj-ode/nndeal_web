<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddCategory;
use App\Models\Admin;
use App\Models\WechatMenu;
use App\Models\Catalog;
use App\Models\Power;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Library\Categores;
use App\Http\Requests;
use App\Http\Controllers\BackendController;

class WechatMenuController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function type()
    {
        $type[1]='显示';
        $type[0]='不显示';
        return $type;
    }

    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.wechatMenu.index', compact('parent_id'));
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
            $countData = WechatMenu::countNumber();

            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;

            $type=$this->type();
            $data['data'] = WechatMenu::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $key);
            foreach ($data['data'] as $k=>$v){
                $v['show'] = $type[$v['show']];
            }
            return response()->json($data);
        }
    }
    //子菜单页面
    public function son(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.wechatMenu.son', compact('parent_id'));
    }
    //子菜单首页查询
    public function indexDataSon(Request $request)
    {
        if ($request->ajax()) {

            $search = $request->get('search');//获取前台传过来的过滤条件
            $key = $request->get('parent_id');//获取前台传过来的过滤条件
            $start = $request->get('start', '0');
            $length = $request->get('length', '10');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');

            /*$key = $search['value'];*/
            $countData = WechatMenu::countNumberSon();

            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;

            $type=$this->type();
            $data['data'] = WechatMenu::allListDataSon($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $key);
            foreach ($data['data'] as $k=>$v){
                $v['show'] = $type[$v['show']];
            }
            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function soncreate(Request $request)
    {

        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.wechatMenu.soncreate', compact('parent_id'));
    }
    //子菜单增加
    public function storeson(Request $request)
    {
        $parent_id=$request->get('parent_id');
        $result = ['status' => false, 'message' => '保存失败!','parent_id'=>$parent_id];
        $question = new WechatMenu();
        $question->name = $request->get('name');
        $question->parent_id = $parent_id;
        $question->url = $request->get('url');
        $question->show = $request->get('show','0');
        $question->sort = $request->get('sort',0);

        if ($question->save()) {
            // dispatch(new AddCategory($question->id));
            $result = ['status' => true, 'message' => '保存成功!','parent_id'=>$parent_id];
        }
        return response()->json($result);
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
            $question = new WechatMenu();
            $question->label = $request->get('label');
            $question->name = $request->get('name');
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
        $result = WechatMenu::getId($id);

        $menu = Catalog::orderBy('parent_id','sort')->get()->toArray();
        $categores = new Categores();
        $data_menu= $categores->cateToOne($menu);

        return view('Backend.admin.wechatMenu.update', compact('parent_id', 'result','data_menu'));
    }
    //修改页面子菜单
    public function updateson(Request $request){
        $parent_id = $request->get('parent_id', 0);
        $id =  $request->get('id');
        $result = WechatMenu::getId($id);

        $menu = Catalog::orderBy('parent_id','sort')->get()->toArray();
        $categores = new Categores();
        $data_menu= $categores->cateToOne($menu);

        return view('Backend.admin.wechatMenu.updateson', compact('parent_id', 'result','data_menu'));
    }
    //修改功能子菜单功能
    public function update_save_son(Request $request){
        $parent_id=$request->get('parent_id');
        $data['name']=$request->get('name');
        $data['parent_id']=$parent_id;
        $data['url']=$request->get('url');
        $data['type']=$request->get('type');
        $data['sort']=$request->get('sort','0');
        $data['show']=$request->get('show','0');
        $res= WechatMenu::updateData($request->get('id'),$data);
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!','parent_id'=>$parent_id];
        }else{
            $result = ['status' => false, 'message' => '保存失败!','parent_id'=>$parent_id];
        }
        return response()->json($result);
    }
    //修改功能
    public function update_save(Request $request){
        $data['name']=$request->get('name');
        $data['sort']=$request->get('sort','0');
        $data['show']=$request->get('show','0');
        $data['parent_id']=0;
        $res= WechatMenu::updateData($request->get('id'),$data);
        if ($res) {
                $result = ['status' => true, 'message' => '保存成功!'];
        }else{
                $result = ['status' => false, 'message' => '保存失败!'];
        }
        return response()->json($result);
    }

    //删除
    public function del(Request $request){
        $id = $request->get('id');
        $parent_id=$request->get('parent_id');
        WechatMenu::where('id',$id)->delete();
        return  redirect("admin/wechatMenu/son?parent_id=$parent_id");
    }

}
