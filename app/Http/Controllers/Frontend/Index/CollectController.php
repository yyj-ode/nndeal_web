<?php

namespace App\Http\Controllers\Frontend\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use App\Models\Question;
use Carbon\Carbon;

use App\Jobs\AddUsers;

/**
 * 采集类
 * Class CollectController
 * @package App\Http\Controllers\Frontend\Index
 */
class CollectController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function content(Request $request)
    {
        info(json_encode($request->all()));
        if ($request->isMethod('post')) {
            $category = $request->get('category');
            $keywords = $request->get('keywords');
            $description = str_replace('_飞华健康问答', '',str_replace('_飞华健康网', '',strip_tags(htmlspecialchars_decode($request->get('description')))));
            $title = $request->get('title');
            $symptom = strip_tags($request->get('symptom'));
            $age = $request->get('age');
            $sex = $request->get('sex');
            $id = $request->get('id');
            $user_id = $request->get('user_id');
            $created_at = $request->get('created_at');
            $area = $request->get('area');

            if (!empty($description) && $user_id) {
                $question = Question::where('id', $id)->first();
                if ($question) {
                    $question->user_id = trim($user_id);
                    $question->title = trim($title);
                    $question->year = trim($age) ? (date('Y', time()) - $age) : date('Y', time());
                    $question->sex = trim($sex) ? 1 : 2;
                    $question->keywords = trim($keywords);
                    $question->symptom = trim($symptom);
                    $question->category_id = trim($category);
                    $question->description = trim($description);
                    $question->created_at = trim($created_at) != null ? trim($created_at) : Carbon::now();
                    $question->area = trim($area);
                    $question->display = 1;
                    $question->status = 1;
                    if ($question->save()) {
                        QuestionStore::addById($id);
                        dispatch(new AddUsers($user_id));
                    }
                } else {
                    $question = new Question();
                    $question->id = trim($id);
                    $question->user_id = trim($user_id);
                    $question->title = trim($title);
                    $question->year = trim($age) ? (date('Y', time()) - $age) : date('Y', time());
                    $question->sex = trim($sex) ? 1 : 2;
                    $question->keywords = trim($keywords);
                    $question->symptom = trim($symptom);
                    $question->category_id = trim($category);
                    $question->description = trim($description);
                    $question->created_at = trim($created_at) != null ? trim($created_at) : Carbon::now();
                    $question->area = trim($area);
                    $question->display = 1;
                    $question->status = 1;
                    if ($question->save()) {
                        QuestionStore::addById($id);
                        dispatch(new AddUsers($user_id));
                    }
                }
            }
        }
        return response()->json(['status' => 200]);
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
}
