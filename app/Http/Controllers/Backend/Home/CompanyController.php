<?php

namespace App\Http\Controllers\Backend\Home;

use App\Jobs\AddCompany;
use App\Jobs\AddQuestion;
use App\Models\CompanyContact;
use App\Models\CompanyDescription;
use App\Store\AreaStore;
use App\Store\CompanyStore;
use App\Store\CategoryStore;
use Illuminate\Http\Request;
use App\Models\Company;

use App\Http\Requests;
use App\Http\Controllers\BackendController;

class CompanyController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Backend.admin.company.index');
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

            $data['data'] = CompanyStore::allListData($start, $length, $columns[$order[0]['column']]['data'], $order[0]['dir'], $status);

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
        $allData = [];
        $result = Company::getDataById($id);
        $category = CategoryStore::getByParentId();
        $area = AreaStore::getByParentId();
//        $keywords = $this->getKeywords($id);
//        $allData['keywords'] = $keywords ? $keywords : $result->keywords;
//        $allData['tag'] = $keywords ? $keywords : $result->tag;
        return view('Backend.admin.company.edit', compact('allData', 'result', 'category', 'area'));
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
        $company = Company::where('id', $request->get('id'))->first();

        if ($company) {

            if (!empty($request->get('check_category'))) {
                $company->category_id = $request->get('category_id');
            }

            if (!empty($request->get('check_area'))) {
                $company->province = $request->get('province');
                $company->city = $request->get('city');
                $company->county = $request->get('county');
            }

            $company->title = $request->get('title');
            $company->keywords = $request->get('keywords');
            $company->summary = $request->get('summary');
            $company->weight = $request->get('weight');
            $company->status = $request->get('status');
            $company->display = $request->get('display');

            if ($company->save()) {
                dispatch(new AddCompany($company->id));
                $result = ['status' => true, 'message' => '保存成功!'];
            }
        }

        return response()->json($result);
    }

    /**
     * 编辑详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function description($id)
    {
        $result = CompanyDescription::getDataById($id);
        return view('Backend.admin.company.description', compact('result'));
    }


    public function doDescription(Request $request)
    {
        $result = ['status' => false, 'message' => ''];
        $id = $request->get('id');
        $company = CompanyDescription::where('id', $id)->first();
        if ($company) {
            $company->description = $request->get('description');
            $company->business = $request->get('business');
            if ($company->save()) {
                dispatch(new AddCompany($id));
                $result = ['status' => true, 'message' => '保存成功!'];
            }
        }

        return response()->json($result);
    }

    /**
     * 编辑联系方式
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact($id)
    {
        $result = CompanyContact::getDataById($id);
        return view('Backend.admin.company.contact', compact('result'));
    }


    public function doContact(Request $request)
    {
        $result = ['status' => false, 'message' => ''];
        $id = $request->get('id');
        $model = CompanyContact::where('id', $id)->first();
        if ($model) {

            $model->source = $request->get('source');                             //来源
            $model->name = $request->get('name');                                  //联系人
            $model->phone = $request->get('phone');                                //联系电话
            $model->mobile = $request->get('mobile');                            //联系手机
            $model->qq = $request->get('qq');                                     //企业QQ
            $model->web = $request->get('web');                                    //企业网站
            $model->fax = $request->get('fax');                                    //传真
            $model->email = $request->get('email');                                //企业邮箱
            $model->zipcode = $request->get('zipcode');                           //邮编
            $model->corporation = $request->get('corporation');                    //法人
            $model->capital = $request->get('capital');                          //注册资金
            $model->validity = $request->get('validity');                         //有效期
            $model->certificate = $request->get('certificate');                   //税务登记证
            $model->institutional = $request->get('institutional');                //组织机构代码证
            $model->aptitude_id = intval($request->get('aptitude_id'));                   //资质
            $model->licence_id = intval($request->get('licence_id'));                     //营业执照
            $model->services = $request->get('services');                         //产品和服务
            $model->company_type = $request->get('company_type');                //公司类型
            $model->company_code = $request->get('company_code');                 //公司营业执照号
            $model->operation_startdate = $request->get('operation_startdate');    //成立日期
            $model->operation_enddate = $request->get('operation_enddate');        //营业期限
            $model->authority = $request->get('authority');                        //登记机关
            $model->company_status = $request->get('company_status');              //公司状态

            if ($model->save()) {
                dispatch(new AddCompany($id));
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
