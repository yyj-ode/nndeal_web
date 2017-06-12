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
use App\Models\Answer;
use App\Models\Order;
use App\Store\AnswerStore;
use App\Jobs\CityName;
use Carbon\Carbon;
use Cookie;
use App\Jobs\AddUsers;
use App\Jobs\SendBearyChat;
use App\Library\Paginations;

class OrdersController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Frontend.Center.Web.Orders.index');
    }
    public function status(){
        $status[5] = '待支付';
        $status[1] = '已支付';
        $status[3] = '撤销';
        return $status;
    }
    public function order(){
        $user_id=4;
        $result=Order::getUsersData($user_id);
        dd($result);
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
}
