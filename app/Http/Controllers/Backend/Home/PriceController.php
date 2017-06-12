<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\Price;
use App\Models\Power;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Http\Controllers\BackendController;

class PriceController extends BackendController
{
    /**
     * 显示金额搜索条件首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('Backend.admin.price.index');
    }

    /**
     * 获取首页数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexdata(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->get('start', '0');
            $length = $request->get('length', '10');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');
            $countData = Price::countNumber();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = Price::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir']);
            return response()->json($data);
        }
    }

    /**
     * 新建价格搜索条件
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('Backend.admin.price.create');
    }

    /**
     * 存储价格搜索条件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $question = new Price();
        $id = $request->get('id',null);
        $question->min_price = $request->get('min_price');
        $question->max_price = $request->get('max_price');
        if(null == $id){
            $data['created_at'] = $request->get('created_at');
            if ($question->save()) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
            return response()->json($result);
        }else{
            $data['min_price'] = $request->get('min_price');
            $data['max_price'] = $request->get('max_price');
            $data['updated_at'] = $request->get('updated_at');
            $res= Price::updateData($question,$id,$data);
            if ($res) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
            return response()->json($result);
        }
    }

    /**
     * 更新搜索条件
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $id =  $request->get('id');
        $result = Price::getDataById($id);
        $result = $result['original'];

        return view('Backend.admin.price.edit', compact('result'));
    }

    /**
     * 删除搜索条件
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function del(Request $request)
    {
        $id = $request->get('id');
        $res = Price::destroy($id);
        return redirect('admin/price/index');
    }

}
