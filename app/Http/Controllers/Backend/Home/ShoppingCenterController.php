<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\ShoppingCenter;
use App\Models\Power;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Http\Controllers\BackendController;

class ShoppingCenterController extends BackendController
{
    /**
     * 显示购物中心管理首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('Backend.admin.shoppingcenter.index');
    }

    /**
     * 获取首页信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexData(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->get('start', '0');
            $length = $request->get('length', '10');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');
            $countData = ShoppingCenter::count();
            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;
            $data['data'] = ShoppingCenter::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir']);
//            dd($data);
            return response()->json($data);
        }
    }

    /**
     * 新建购物中心
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('Backend.admin.shoppingcenter.create');
    }

    /**
     * 存储购物中心
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $ShoppingCenter = new ShoppingCenter();
        $data['project_name'] = $request->get('project_name',null);
        $data['opening_date'] = $request->get('opening_date',null);
        $data['condition'] = $request->get('condition',null);
        $data['commercial_area'] = $request->get('commercial_area',null);
        $data['commercial_floors'] = $request->get('commercial_floors',null);
        $data['project_adress'] = $request->get('project_adress',null);
        $data['project_photo'] = $request->get('image1',null);
        $data['project_mapping'] = $request->get('project_mapping',null);
        $data['contact_brand'] = $request->get('contact_brand',null);
        $data['demand'] = $request->get('demand',null);
        $data['inner_map'] = $request->get('image2',null);
        $res= $ShoppingCenter->addData($ShoppingCenter,$data);
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
    }

    /**
     * 更新购物中心
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $_id = $request->get('_id',0);
        $result = shoppingcenter::find($_id);
        return view('Backend.admin.shoppingcenter.edit', compact('result','_id'));
    }

    /**
     * 显示购物中心详情
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $_id = $request->get('_id',0);
        $result = shoppingcenter::find($_id);
        return view('Backend.admin.shoppingcenter.detail', compact('result','_id'));
    }

    /**
     * 保存购物中心信息修改
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doupdate(Request $request)
    {
        $result = ['status' => false, 'message' => '保存失败!'];
        $id = $request->get('_id',null);
        $ShoppingCenter = new ShoppingCenter();
        $data['project_name'] = $request->get('project_name',null);
        $data['opening_date'] = $request->get('opening_date',null);
        $data['condition'] = $request->get('condition',null);
        $data['commercial_area'] = $request->get('commercial_area',null);
        $data['commercial_floors'] = $request->get('commercial_floors',null);
        $data['project_adress'] = $request->get('project_adress',null);
        $data['project_photo'] = $request->get('image1',null);
        $data['project_mapping'] = $request->get('project_mapping',null);
        $data['contact_brand'] = $request->get('contact_brand',null);
        $data['demand'] = $request->get('demand',null);
        $data['inner_map'] = $request->get('image2',null);
        $res = ShoppingCenter::updateData($ShoppingCenter, $id, $data);
        if ($res) {
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
    }

    /**
     * 删除购物信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function del(Request $request)
    {
        $id = $request->get('_id',null);
        $res= ShoppingCenter::destroy($id);
        if ($res) {
            return redirect('admin/shoppingcenter/index');
        }else{
            $result = ['status' => true, 'message' => '删除失败!'];
            return response()->json($result);
        }

    }

}
