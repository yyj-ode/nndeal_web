<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\Collection;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Cookie;
use App\Http\Controllers\BackendController;

class CollectionController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Backend.admin.collection.index');
    }


    /**
     * 获取数据。。。。
     * @param Request $request
     * @return mixed
     */
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

            $countData = Collection::countNumber();

            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;

            $data['data'] = Collection::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $parent_id);

            foreach ($data['data'] as $k=>$v){
                $data['data'][$k]['name'] = $v['users']['name'];
                $data['data'][$k]['shop_name'] = $v['shop']['shop_name'];
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
        $shop = Shop::get();
        $users = User::get();
        return view('Backend.admin.collection.create', compact('shop','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $question = new Collection();
        $id = $request->get('id',null);
        $question->shop_id = $request->get('shop_id');
        $question->users_id = $request->get('users_id');
        if(null == $id){
            if ($question->save()) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
            return response()->json($result);
        }else{
            $data['shop_id'] = $request->get('shop_id');
            $data['users_id'] = $request->get('users_id');
            $data['updated_at'] = $request->get('updated_at');
            $data['created_at'] = $request->get('created_at');
            $res= Collection::updateData($question,$id,$data);
            if ($res) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
            return response()->json($result);
        }


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id =  $request->get('id');
        $shop = Shop::get();
        $users = User::get();
        $result = Collection::getDataById($id);
        $result = $result['original'];
        return view('Backend.admin.collection.edit', compact('result','users','shop'));
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function del(Request $request)
    {
        $id = $request->get('id');
        $res = Collection::destroy($id);
        return redirect('admin/collection/index');
    }
}
