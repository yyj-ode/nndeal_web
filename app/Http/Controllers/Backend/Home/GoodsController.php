<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\Goods;
use App\Models\Power;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Http\Controllers\BackendController;

class GoodsController extends BackendController
{
    /**
     * 显示首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id',0);
        return view('Backend.admin.goods.index',compact('parent_id'));
    }

    /**
     * 获取首页数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexdata(Request $request)
    {
        if ($request->ajax()) {
            $key = $request->get('parent_id');
            $start = $request->get('start', '0');
            $length = $request->get('length', '10');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');
            $countData = Goods::countNumber();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = Goods::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'],$key);
            return response()->json($data);
        }
    }

    /**
     * 新建商品
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('Backend.admin.goods.create');
    }

    /**
     * 存储商品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $question = new Goods();
        $id = $request->get('id',null);
        $question->name = $request->get('name');
        $question->price = $request->get('price');
        $question->content = $request->get('content');
        $question->status = 5;
        if(null == $id){
            $data['created_at'] = $request->get('created_at');
            if ($question->save()) {
                //dispatch(new AddCategory($question->id));
                $result = ['status' => true, 'message' => '保存成功!'];
            }
            return response()->json($result);
        }else{
            $data['name'] = $request->get('name');
            $data['price'] = $request->get('price');
            $data['content'] = $request->get('content');
            $data['updated_at'] = $request->get('updated_at');
            $data['status'] = 5;
            $res= Goods::updateData($question,$id,$data);
            if ($res) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
            return response()->json($result);
        }
    }

    /**
     * 更新商品
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $id =  $request->get('id');
        $result = Goods::getDataById($id);
        $result = $result['original'];
        return view('Backend.admin.goods.edit', compact('result'));
    }

    /**
     * 删除商品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function del(Request $request)
    {
        $id = $request->get('id');
        $data['status'] = 3;
        $question = new Goods();
        $res= Goods::updateData($question,$id,$data);
        if ($res) {
            return redirect('admin/goods/index');
        }else{
            $result = ['status' => true, 'message' => '删除失败!'];
            return response()->json($result);
        }

    }

}
