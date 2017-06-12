<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddBanner;
use App\Models\Banner;
use App\Store\BannerStore;
use App\Store\BannerSortStore;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;

class BannerController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Backend.admin.banner.index');
    }

    public function indexData(Request $request)
    {
        if ($request->ajax()) {

            $search = $request->get('search');//获取前台传过来的过滤条件
            $status = $request->get('status');//获取前台传过来的过滤条件
            $start = $request->get('start', '0');
            $length = $request->get('length', '10');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $data['draw'] = $request->get('draw', '1');
            $data['recordsTotal'] = 10000000;
            $data['recordsFiltered'] = 10000000;

            if (count($search) != 0) {
                $search_data = $search['value'];
            }

            $data['data'] = BannerStore::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $status);

            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = BannerSortStore::getByParentId();
        return view('Backend.admin.banner.create', compact('category'));
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
        $banner = new Banner();
        if (!empty($request->get('check_category'))) {
            $banner->category_id = $request->get('category_id');
        }
        $banner->name = $request->get('name');
        $banner->url = $request->get('url');
        $banner->description = $request->get('description');
        $banner->sort_order = $request->get('sort_order');
        $banner->end_time = $request->get('end_time');
        $banner->status = $request->get('status');
        $banner->display = $request->get('display');
        if ($banner->save()) {
            dispatch(new AddBanner($banner->id));
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
        $result = Banner::getDataById($id);
        $category = BannerSortStore::getByParentId();
        return view('Backend.admin.banner.edit', compact('result', 'category'));
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
        $banner = Banner::where('id', $request->get('id'))->first();

        if ($banner) {

            if (!empty($request->get('check_category'))) {
                $banner->category_id = $request->get('category_id');
            }

            $banner->name = $request->get('name');
            $banner->url = $request->get('url');
            $banner->description = $request->get('description');
            $banner->sort_order = $request->get('sort_order');
            $banner->end_time = $request->get('end_time');
            $banner->status = $request->get('status');
            $banner->display = $request->get('display');

            if ($banner->save()) {
                dispatch(new AddBanner($banner->id));
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

    }
}
