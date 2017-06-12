<?php

namespace App\Http\Controllers\Frontend\Center;

use App\Models\DiseaseCategory;
use App\Models\Keyword;
use App\Models\User;
use App\Store\KeywordsStore;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use Response;
use App\Utils\SSDBUtil;
use App\Utils\RedisUtil;
use App\Models\Question;
use App\Store\QuestionStore;
use App\Jobs\CityName;
use Carbon\Carbon;
use Cookie;
use App\Jobs\AddUsers;
use App\Jobs\SendBearyChat;
use App\Library\Paginations;

class QuestionController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allData = [];
        $page = $request->get('page', 1);
        $pageSize = 10;
        $offset = $pageSize * ($page - 1);
        $user_id = $this->guard()->user()->id;

        $questions = QuestionStore::getListByUserId($user_id, $pageSize, $offset);
        $allData['questions'] = $questions;

        $total = QuestionStore::getCountByUserId($user_id);
        $allData['total'] = $total;
        $allData['totalPage'] = ceil($total / $pageSize);

        /**
         * 分页
         */
        $pagination = new Paginations();
        $pageConfig = array(
            'url'       => config('common.short_url') . DIRECTORY_SEPARATOR . 'center' . DIRECTORY_SEPARATOR . 'question' . DIRECTORY_SEPARATOR,
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
        $allData['total'] = $total;
        return view('Frontend.Center.Web.Question.index', compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

    }

    public function checkLogin()
    {

    }

    public function demo()
    {

    }

    public function test()
    {
        $data = ['test' => 'test'];
        return Response::json($data);
    }
}
