<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Question;
use Cookie;
use App\Http\Requests;
use App\Http\Controllers\BackendController;

class CategoryController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_id = $request->get('parent_id', 0);
        return view('Backend.admin.category.index', compact('parent_id'));
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

            $countData = Category::countNumber($parent_id);

            $data['recordsTotal'] = $countData;
            $data['recordsFiltered'] = $countData;

            $data['data'] = Category::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $parent_id);

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
        $category = Category::getByParentId($parent_id);
        return view('Backend.admin.category.create', compact('parent_id', 'category'));
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
        $question = new Category();
        $question->parent_id = $request->get('parent_id');
        $question->title = $request->get('title');
        $question->keywords = $request->get('keywords');
        $question->description = $request->get('description');
        $question->status = $request->get('status');
        $question->show = $request->get('show');
        $question->type = $request->get('type');
        if ($question->save()) {
            //dispatch(new AddCategory($question->id));
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
    public function edit($id)
    {

        $result = Category::getDataById($id);

        $category = CategoryStore::getByParentId();
        return view('Backend.admin.category.edit', compact('result', 'category'));
    }

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
    public function update(Request $request)
    {
        $result = ['status' => false, 'message' => ''];
        $question = Category::where('id', $request->get('id'))->first();

        if ($question) {
            if ($request->get('check_category') == 1) {
                $question->parent_id = $request->get('parent_id');
            }
            $question->category_name = $request->get('category_name');
            $question->keywords = $request->get('keywords');
            $question->description = $request->get('description');
            $question->status = $request->get('status');
            $question->show = $request->get('show');
            if ($question->save()) {
                dispatch(new AddCategory($question->id));
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
