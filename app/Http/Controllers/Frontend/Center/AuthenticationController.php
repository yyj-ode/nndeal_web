<?php

namespace App\Http\Controllers\Frontend\Center;

use App\Models\Authentication;
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

class AuthenticationController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Frontend.Center.Web.Authentication.index');
    }
    public function authentication_sort(Request $request){
        if($request->ajax('post')){
            $result = ['status' => false, 'message' => '提交失败!'];
            $Authentication = new Authentication();
            $users_id = 4;
            $Authentication->card = $request->get('card');
            $Authentication->users_id = $users_id;
            $Authentication->type = $request->get('type');
            $Authentication->roles = $request->get('roles');
            $Authentication->time = $request->get('time');
            $res=$Authentication ->save();
            if ($res) {
                $result = ['status' => true, 'message' => '保存成功!'];
            }
            return response()->json($result);
        }
    }
    public function add(Request $request)
    {
        return view('Frontend.Center.Web.Authentication.add');
    }
    public function add_action(Request $request){
        $file = dump($request);

        dd($file);
    }


}
