<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddFriendship;
use App\Models\Friendship;
use App\Store\AreaStore;
use App\Store\FriendshipStore;
use App\Store\FriendshipSortStore;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendController;

class FriendshipController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Backend.admin.friendship.index');
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

            $data['data'] = FriendshipStore::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $status);

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
        $category = FriendshipSortStore::getByParentId();
        return view('Backend.admin.friendship.create', compact('category'));
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
        $friendship = new Friendship();
        if (!empty($request->get('check_category'))) {
            $friendship->category_id = $request->get('category_id');
        }
        $friendship->name = $request->get('name');
        $friendship->url = $request->get('url');
        $friendship->description = $request->get('description');
        $friendship->sort_order = $request->get('sort_order');
        $friendship->end_time = $request->get('end_time');
        $friendship->status = $request->get('status');
        $friendship->display = $request->get('display');
        if ($friendship->save()) {
            dispatch(new AddFriendship($friendship->id));
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
        $result = Friendship::getDataById($id);
        $category = FriendshipSortStore::getByParentId();
        return view('Backend.admin.friendship.edit', compact('result', 'category'));
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
        $friendship = Friendship::where('id', $request->get('id'))->first();

        if ($friendship) {

            if (!empty($request->get('check_category'))) {
                $friendship->category_id = $request->get('category_id');
            }

            $friendship->name = $request->get('name');
            $friendship->url = $request->get('url');
            $friendship->description = $request->get('description');
            $friendship->sort_order = $request->get('sort_order');
            $friendship->end_time = $request->get('end_time');
            $friendship->status = $request->get('status');
            $friendship->display = $request->get('display');

            if ($friendship->save()) {
                dispatch(new AddFriendship($friendship->id));
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
