<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddBannerSort;
use App\Models\BannerSort;
use App\Store\BannerSortStore;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;

class BannerSortController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.bannersort.index', compact('parent_id'));
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

            if (count($search) != 0 && !empty($search['value'])) {
                $parent_id = $search['value'];
            }

            $countData = BannerSortStore::countNumber($parent_id);

            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;

            $data['data'] = BannerSortStore::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $parent_id);

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
        $category = BannerSortStore::getByParentId();
        return view('Backend.admin.bannersort.create', compact('parent_id', 'category'));
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
        $friendship = new BannerSort();
        $friendship->parent_id = $request->get('parent_id');
        $friendship->sort_name = $request->get('sort_name');
        if ($friendship->save()) {
            dispatch(new AddBannerSort($friendship->id));
            $result = ['status' => true, 'message' => '保存成功!'];
        }
        return response()->json($result);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = BannerSort::getDataById($id);
        $category = BannerSortStore::getByParentId();
        return view('Backend.admin.bannersort.edit', compact('result', 'category'));
    }

    /**
     * 获取所有下一级数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function category(Request $request)
    {
        $id = $request->get('id');
        $data = BannerSortStore::getByParentIds($id);
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
        $data = BannerSortStore::checkByParentId($id);
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
    public function update(Request $request)
    {
        $result = ['status' => false, 'message' => ''];
        $friendship = BannerSort::where('id', $request->get('id'))->first();

        if ($friendship) {
            if ($request->get('check_category') == 1) {
                $friendship->parent_id = $request->get('parent_id');
            }
            $friendship->sort_name = $request->get('sort_name');
            $friendship->description = $request->get('description');
            if ($friendship->save()) {
                dispatch(new AddBannerSort($friendship->id));
                $result = ['status' => true, 'message' => '保存成功!'];
            }
        }

        return response()->json($result);
    }

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
