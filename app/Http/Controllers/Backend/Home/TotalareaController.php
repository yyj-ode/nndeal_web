<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\Totalarea;
use App\Models\Power;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Http\Controllers\BackendController;

class TotalareaController extends BackendController
{

    /**
     * 显示面积管理首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('Backend.admin.totalarea.index');
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
            $countData = Totalarea::countNumber();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = Totalarea::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir']);
            return response()->json($data);
        }
    }

    /**
     * 增加面积管理范围
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('Backend.admin.totalarea.create');
    }

    /**
     * 存储面积管理范围
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $question = new Totalarea();
        $id = $request->get('id',null);
        $question->min_area = $request->get('min_area');
        $question->max_area = $request->get('max_area');
        if(null == $id){
            $data['created_at'] = $request->get('created_at');
            if ($question->save()) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
            return response()->json($result);
        }else{
            $data['min_area'] = $request->get('min_area');
            $data['max_area'] = $request->get('max_area');
            $data['updated_at'] = $request->get('updated_at');
            $res= Totalarea::updateData($question,$id,$data);
            if ($res) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
            return response()->json($result);
        }
    }

    /**
     * 更新面积管理范围
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $id =  $request->get('id');
        $result = Totalarea::getDataById($id);
        $result = $result['original'];
        return view('Backend.admin.totalarea.edit', compact('result'));
    }

    /**
     * 删除面积管理范围
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function del(Request $request)
    {
        $id = $request->get('id');
        $res = Totalarea::destroy($id);
        return redirect('admin/totalarea/index');
    }

}
