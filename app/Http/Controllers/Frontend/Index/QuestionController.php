<?php

namespace App\Http\Controllers\Frontend\Index;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Category;
use App\Models\Answer;
use App\Models\DiseaseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use Response;
use Validator;
use Auth;

use App\Jobs\AnswerCity;

use App\Library\Paginations;
use App\Utils\Common;

class QuestionController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        ini_set("max_execution_time", "0");
        $page = $request->get('page');
        $pageSize = 1000;
        $offset = $pageSize * ($page - 1);

        $data = Question::limit((int)$pageSize)
            ->skip((int)$offset)
            ->orderBy('id', 'desc')->get();

        foreach ($data as $item) {
            $this->addask($item->id);
        }
        dd(999);
    }

    public function addask($id)
    {
        QuestionStore::addById($id);
    }

    public function add($id)
    {
        $model = DiseaseCategory::whereId($id)->first();
        DiseaseCategoryStore::add($model);
        return true;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Frontend.Index.Web.Question.create');
    }

    /**
     * Store a newly created resource in storage.
     * 添加保存问题
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = ['status' => false, 'message' => ''];
        if ($request->has('captcha') && $request->get('captcha')) {
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $message['message'] = '验证码不不正确！';
                return Response::json($message);
            }
        } else {
            $message['message'] = '验证码不能为空！';
            return Response::json($message);
        }

        if (empty($request->get('year')) || empty($request->get('title')) || empty($request->get('description'))) {
            $message['message'] = '标题，描述，年龄不能为空！';
            return Response::json($message);
        }

        $model = new Question();
        $model->title = $request->get('title');
        $model->description = $request->get('description');
        $model->help = $request->get('help');
        $model->user_id = Auth::guard('user')->user()->id;

        if ($request->get('category_id', '')) {
            $model->category_id = $request->get('category_id', '');
        }

        $model->sex = $request->get('sex');
        $model->year = $request->get('year');
        $model->status = 5;
        $model->ip = $request->ip();
        if ($model->save()) {
            dispatch(new AnswerCity($model));
            QuestionStore::addById($model->id);
            $message = ['status' => true, 'message' => '保存成功！'];
        } else {
            $message['message'] = '保存失败！';
        }
        return Response::json($message);
    }

    /**
     * Display the specified resource.
     * 问题列表
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function lists($category_id, $status = 6, $page = 1)
    {
//        dd(Common::hashidEncode('1283'));
//        $categoryId = Common::hashidDecode($category_id);
        $allData = [];
        $pageSize = config('common.page_size');
        $offset = $pageSize * ($page - 1);
        $questions = QuestionStore::getList($category_id, $pageSize, $offset, $status);
        $allData['questions'] = $questions;
        
        $total = QuestionStore::counts($category_id,$status);
        $allData['total'] = $total;
        $allData['totalPage'] = ceil($total / $pageSize);

        $category = DiseaseCategoryStore::getCategory($category_id);
        $allData['category'] = $category;

        /**
         * 分页
         */
        $pagination = new Paginations();
        $pageConfig = array(
            'url'       => config('common.short_url') . DIRECTORY_SEPARATOR . 'question' . DIRECTORY_SEPARATOR . 'c' . $category_id . 's' . $status,
            'seg'       => 3,
            'part'      => 2,
            'mode'      => 3,
            'nowindex'  => $page,
            'total'     => $total,
            'perpage'   => $pageSize,
            'pre_page'  => '<i class="fa fa-angle-left"></i>',
            'next_page' => '<i class="fa fa-angle-right"></i>',
        );

        $pagination->next_page('next');
        $pagination->pre_page('prev');
        $pagination->nowbar('page-numbers current');

        $pagination->initialize($pageConfig);
        $pageUrl = $pagination->show();
        $allData['pageUrl'] = $pageUrl;

        /**
         * 当前位置
         */
        $categoryLinkData = DiseaseCategoryStore::getCatgoryLink($category_id);
        $allData['categoryLinkData'] = $categoryLinkData;
        $allData['category_id'] = $category_id;
        $allData['status'] = $status;
        $allData['total'] = $total;

        return view('Frontend.Index.Web.Question.lists', compact('allData'));
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     * 采纳问题
     */
    public function adopt()
    {
        return view('Frontend.Center.Web.Question.adopt');
    }

    /**
     * Display the specified resource.
     * 问题详情
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($question_id)
    {
        $allData = [];
        $question = QuestionStore::getDataById($question_id);
        $allData['question'] = $question;
        $categoryId = $question->category_id;

        /**
         * 当前位置
         */
        $categoryLinkData = DiseaseCategoryStore::getCatgoryLink($categoryId);
        $allData['categoryLinkData'] = $categoryLinkData;

        /**
         * 所有答案,追问,回答追问,补充说明
         */
        $answers = AnswerStore::getDataByQuestionId($question_id);

        return view('Frontend.Index.Web.Question.show', compact('question', 'allData', 'answers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     * 问题补充说明(type:2)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function supply(Request $request)
    {
        $message = ['status' => false, 'message' => ''];
        $user_id = $this->guard()->user()->id;

        if($request->get('type') != 8){
            if ($request->has('captcha') && $request->get('captcha')) {
                $rules = ['captcha' => 'required|captcha'];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $message['message'] = '验证码不不正确！';
                    return Response::json($message);
                }
            } else {
                $message['message'] = '验证码不能为空！';
                return Response::json($message);
            }
        }

        if (empty($request->get('content'))) {
            $message['message'] = '问题内容不能为空！';
            return Response::json($message);
        }
        $analyse = $request->get('analyse', '');
        $answer_id = $request->get('answer_id', '');
        $model = new Answer();
        if (!empty($analyse)) {
            $model->analyse = $analyse;
        }

        if (!empty($answer_id)) {
            $model->answer_id = $answer_id;
        }

        $model->suggestion = $request->get('content');
        $model->question_id = $request->get('q_id');
        $model->user_id = $user_id;
        $model->ip = $request->ip();
        $model->type = 2;
        if ($model->save()) {
            dispatch(new AnswerCity($model));
            AnswerStore::addById($model->id);
            $message = ['status' => true, 'message' => '保存成功！'];
        } else {
            $message['message'] = '保存失败！';
        }
        return Response::json($message);
    }

    /**
     * 保存追问(type:4)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function trace(Request $request)
    {
        $message = ['status' => false, 'message' => ''];
        $user_id = $this->guard()->user()->id;

        if ($request->has('captcha') && $request->get('captcha')) {
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $message['message'] = '验证码不不正确！';
                return Response::json($message);
            }
        } else {
            $message['message'] = '验证码不能为空！';
            return Response::json($message);
        }

        if (empty($request->get('content'))) {
            $message['message'] = '问题内容不能为空！';
            return Response::json($message);
        }
        $analyse = $request->get('analyse', '');
        $answer_id = $request->get('answer_id', '');
        $model = new Answer();
        if (!empty($analyse)) {
            $model->analyse = $analyse;
        }

        if (!empty($answer_id)) {
            $model->answer_id = $answer_id;
        }

        $model->suggestion = $request->get('content');
        $model->question_id = $request->get('q_id');
        $model->answer_id = $request->get('answer_id');
        $model->user_id = $user_id;
        $model->ip = $request->ip();
        $model->type = 4;
        if ($model->save()) {
            dispatch(new AnswerCity($model));
            AnswerStore::addById($model->id);
            $message = ['status' => true, 'message' => '保存成功！'];
        } else {
            $message['message'] = '保存失败！';
        }
        return Response::json($message);
    }
}
