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

class PersonalController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Frontend.Center.Web.Personal.index');
    }

    public function address()
    {
        return view('Frontend.Center.Web.Personal.address');
    }

    public function addaddress()
    {
        return view('Frontend.Center.Web.Personal.addaddress');
    }

    public function editaddress()
    {
        return view('Frontend.Center.Web.Personal.editaddress');
    }

    public function test()
    {
        return view('Frontend.Center.Web.Personal.test');
    }

}
