<?php

namespace App\Http\Controllers;
use App\Store\ArticleStore;
use App\Store\KeywordsStore;
use App\Store\CompanyStore;
use App\Utils\SSDBUtil;
use App\Models\Area;
use Illuminate\Http\Request;
class BackendController extends Controller
{
    public function getKeywords($articleStorId,$all = false){
        $description = CompanyStore::getDescriptionData($articleStorId);

        $ssdb_key = 'allKeywordsDara';
        $ssdb = new SSDBUtil();
        if ($ssdb->exists($ssdb_key)) {
            $keywords = json_decode($ssdb->get($ssdb_key), true);
        } else {
            $keywords = KeywordsStore::getAllKeywords();
            if (is_array($keywords)) {
                $ssdb->set($ssdb_key, json_encode($keywords));
            }
        }

        $data = $this->analysis(strip_tags($description));
        $keywordsResult = array();
        if($data !=  null){
            $temData = explode("|",$data);

            $result = array();
            foreach(array_unique($temData) as $key=>$value){
                if(strlen($value) > 3){
                    $result[] = $value;
                }
            }

            if($all == true){
                $keywordsResult = $result;
            }else{
                $count = 0;
                foreach($result as $key=>$value){
                    if(in_array($value,$keywords)){
                        if($count < 3){
                            $keywordsResult[] = $value;
                            $count++;
                        }
                    }
                }
            }
        }

        return implode('，',$keywordsResult);
    }

    public function analysis($companyName, $separator = "|")
    {
        require_once(app_path('Library' . DIRECTORY_SEPARATOR . 'phpanalysis' . DIRECTORY_SEPARATOR . 'phpanalysis.class.php'));

        \PhpAnalysis::$loadInit = true;
        $analysis = new \PhpAnalysis('utf-8', 'utf-8', true);

        //载入词典
        $analysis->LoadDict();

        //执行分词
        $analysis->SetSource($companyName);
        $analysis->differMax = true;
        $analysis->unitWord = true;
        $analysis->StartAnalysis(false);

        return $analysis->GetFinallyResult($separator, false);
    }

    protected function guard()
    {
        return auth()->guard('admin');
    }

    /**
     * Show the form for creating a new resource.
     *地区市
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $id = $request->get('id');
        $data = Area::where('parent_id',$id)->get();
        return response()->json($data);
    }
}
