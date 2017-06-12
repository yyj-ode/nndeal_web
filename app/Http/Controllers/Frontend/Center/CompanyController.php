<?php

namespace App\Http\Controllers\Frontend\Center;

use App\Jobs\AddCompany;
use App\Models\Company;
use App\Models\CompanyDescription;
use App\Models\CompanyDetails;
use App\Store\CompanyStore;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use Response;
use App\Utils\SSDBUtil;
use App\Utils\RedisUtil;
use App\Store\CategoryStore;
use App\Store\AreaStore;
use Carbon\Carbon;
use Cookie;

class CompanyController extends FrontendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function one()
    {
        $category = CategoryStore::getByParentId();
        $area = AreaStore::getByParentId();
        $user_id = $this->guard()->user()->id;
        $company = CompanyStore::where('user_id', intval($user_id))->first();
        $select_category = CategoryStore::getCatgoryLink('64');

        return view('Frontend.Center.Web.Company.one', compact('area', 'category', 'company', 'select_category'));
    }

    public function postOne(Request $request)
    {
        $user_id = $this->guard()->user()->id;
        $company = Company::where('user_id', intval($user_id))->first();
        $data = ['status' => false, 'message' => '保存失败!'];
        if ($company) {

            $company->title = $request->get('title');
            $company->category_id = $request->get('category_id');
            $company->scale_id = $request->get('scale_id');
            $company->province = $request->get('province');
            $company->city = $request->get('city');
            $company->county = $request->get('county');
            $company->office = $request->get('office');

            if ($company->save()) {
                $company_id = $company->id;
                $details = CompanyDetails::where('id', $company_id)->first();
                if ($details) {
                    $details->company_code = $request->get('company_code');
                    $details->company_status = $request->get('company_status');
                    $details->company_type = $request->get('company_type');
                    $details->name = $request->get('name');
                    $details->mobile = $request->get('mobile');
                    $details->save();
                } else {
                    $details = new CompanyDetails();
                    $details->id = $company_id;
                    $details->company_code = $request->get('company_code');
                    $details->company_status = $request->get('company_status');
                    $details->company_type = $request->get('company_type');
                    $details->name = $request->get('name');
                    $details->mobile = $request->get('mobile');
                    $details->save();
                }

                $description = CompanyDescription::where('id', $company_id)->first();
                if ($description) {
                    $description->business = $request->get('business');
                    $description->description = $request->get('description');
                    $description->save();
                } else {
                    $description = new CompanyDescription();
                    $description->id = $company_id;
                    $description->business = $request->get('business');
                    $description->description = $request->get('description');
                    $description->save();
                }

                dispatch(new AddCompany($company_id));
                $data = ['status' => true, 'message' => '保存成功!', 'url' => url('center/company/tow')];
            }

        } else {
            $company = new Company();
            $company->user_id = $user_id;
            $company->title = $request->get('title');
            $company->category_id = $request->get('category_id');
            $company->scale_id = $request->get('scale_id');
            $company->province = $request->get('province');
            $company->city = $request->get('city');
            $company->county = $request->get('county');
            $company->office = $request->get('office');

            if ($company->save()) {
                $company_id = $company->id;
                $details = CompanyDetails::where('id', $company_id)->first();
                if ($details) {
                    $details->company_code = $request->get('company_code');
                    $details->company_status = $request->get('company_status');
                    $details->company_type = $request->get('company_type');
                    $details->name = $request->get('name');
                    $details->mobile = $request->get('mobile');
                    $details->save();
                } else {
                    $details = new CompanyDetails();
                    $details->id = $company_id;
                    $details->company_code = $request->get('company_code');
                    $details->company_status = $request->get('company_status');
                    $details->company_type = $request->get('company_type');
                    $details->name = $request->get('name');
                    $details->mobile = $request->get('mobile');
                    $details->save();
                }

                $description = CompanyDescription::where('id', $company_id)->first();
                if ($description) {
                    $description->business = $request->get('business');
                    $description->description = $request->get('description');
                    $description->save();
                } else {
                    $description = new CompanyDescription();
                    $description->id = $company_id;
                    $description->business = $request->get('business');
                    $description->description = $request->get('description');
                    $description->save();
                }

                dispatch(new AddCompany($company_id));
                $data = ['status' => true, 'message' => '保存成功!', 'url' => url('center/company/tow')];
            }
        }


        return response()->json($data);
    }

    public function tow()
    {
        $category = CategoryStore::getByParentId();
        $area = AreaStore::getByParentId();
        $user_id = $this->guard()->user()->id;
        $company = CompanyStore::where('user_id', intval($user_id))->first();

        return view('Frontend.Center.Web.Company.tow', compact('area', 'category', 'company'));
    }

    public function postTow(Request $request)
    {
        $user_id = $this->guard()->user()->id;
        $company = Company::where('user_id', intval($user_id))->first();
        $data = ['status' => false, 'message' => '保存失败!'];
        if ($company) {

            $company->office = $request->get('office');

            if ($company->save()) {
                $company_id = $company->id;
                $details = CompanyDetails::where('id', $company_id)->first();
                if ($details) {
                    $details->corporation = $request->get('corporation');
                    $details->capital = $request->get('capital');
                    $details->company_pattern = $request->get('company_pattern');
                    $details->operation_startdate = $request->get('operation_startdate');
                    $details->operation_enddate = $request->get('operation_enddate');
                    $details->company_sales = $request->get('company_sales');
                    $details->web = $request->get('web');
                    $details->company_province = $request->get('company_province');
                    $details->company_city = $request->get('company_city');
                    $details->company_county = $request->get('company_county');
                    $details->bank_account = $request->get('bank_account');
                    $details->company_sales_area = $request->get('company_sales_area');
                    $details->save();
                } else {
                    $details = new CompanyDetails();
                    $details->corporation = $request->get('corporation');
                    $details->capital = $request->get('capital');
                    $details->company_pattern = $request->get('company_pattern');
                    $details->operation_startdate = $request->get('operation_startdate');
                    $details->operation_enddate = $request->get('operation_enddate');
                    $details->company_sales = $request->get('company_sales');
                    $details->web = $request->get('web');
                    $details->company_province = $request->get('company_province');
                    $details->company_city = $request->get('company_city');
                    $details->company_county = $request->get('company_county');
                    $details->bank_account = $request->get('bank_account');
                    $details->company_sales_area = $request->get('company_sales_area');
                    $details->save();
                }

                dispatch(new AddCompany($company_id));
                $data = ['status' => true, 'message' => '保存成功!', 'url' => url('center/company/three')];
            }

        } else {
            $company = new Company();
            $company->user_id = $user_id;
            $company->office = $request->get('office');

            if ($company->save()) {
                $company_id = $company->id;
                $details = CompanyDetails::where('id', $company_id)->first();
                if ($details) {
                    $details->corporation = $request->get('corporation');
                    $details->capital = $request->get('capital');
                    $details->company_pattern = $request->get('company_pattern');
                    $details->operation_startdate = $request->get('operation_startdate');
                    $details->operation_enddate = $request->get('operation_enddate');
                    $details->company_sales = $request->get('company_sales');
                    $details->web = $request->get('web');
                    $details->company_province = $request->get('company_province');
                    $details->company_city = $request->get('company_city');
                    $details->company_county = $request->get('company_county');
                    $details->bank_account = $request->get('bank_account');
                    $details->company_sales_area = $request->get('company_sales_area');
                    $details->save();
                } else {
                    $details = new CompanyDetails();
                    $details->corporation = $request->get('corporation');
                    $details->capital = $request->get('capital');
                    $details->company_pattern = $request->get('company_pattern');
                    $details->operation_startdate = $request->get('operation_startdate');
                    $details->operation_enddate = $request->get('operation_enddate');
                    $details->company_sales = $request->get('company_sales');
                    $details->web = $request->get('web');
                    $details->company_province = $request->get('company_province');
                    $details->company_city = $request->get('company_city');
                    $details->company_county = $request->get('company_county');
                    $details->bank_account = $request->get('bank_account');
                    $details->company_sales_area = $request->get('company_sales_area');
                    $details->save();
                }
                dispatch(new AddCompany($company_id));
                $data = ['status' => true, 'message' => '保存成功!', 'url' => url('center/company/three')];
            }
        }

        return response()->json($data);
    }

    public function three()
    {
        $category = CategoryStore::getByParentId();
        $area = AreaStore::getByParentId();
        return view('Frontend.Center.Web.Company.three', compact('area', 'category'));
    }

    public function mains()
    {
        return view('Frontend.Center.Web.Company.mains');
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
    public function edit()
    {

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
