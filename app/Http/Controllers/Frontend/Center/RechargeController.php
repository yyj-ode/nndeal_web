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

class RechargeController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function first()
    {
        return view('Frontend.Center.Web.Recharge.first');
    }

    public function second()
    {
        return view('Frontend.Center.Web.Recharge.second');
    }

    public function complete()
    {
        return view('Frontend.Center.Web.Recharge.complete');
    }

}
