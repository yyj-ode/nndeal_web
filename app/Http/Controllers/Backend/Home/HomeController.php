<?php

namespace App\Http\Controllers\Backend\Home;

use App\Events\permChangeEvent;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Permission;
use App\Models\Roles;
use App\Models\AdminAdminRole;
use App\Models\AdminPermissionRole;
use App\Library\Categores;
use App\Http\Requests;
use Session;
use App\Http\Controllers\BackendController;

class HomeController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu=$this->data_menu();

        return view('Backend.admin.home.index',compact('menu'));
    }
    // 权限目录
    public function data_menu(){
        $user_data=Session::get('ADMIN_DATA');
        $group=AdminAdminRole::getPermissionData($user_data['id']);
//        dd($group);
        foreach ($group as $k=>$v){
            foreach ($v['permission_role'] as $kk=>$vv){
                $per_id[]=$vv['admin_permission_id'];
            }
        }

        $per_id=array_unique($per_id);
        $data_menu = Permission::getPermission($per_id);
        $new_data = $this->duplication($data_menu);
        $menu=$this->arrToTree($new_data,0);
        return $menu;
    }
    //去重复
    public function duplication($data){
        foreach ($data as $k=>$v){
            $new_data[$v['parent_id']] = $v;
        }
        return $new_data;
    }
    /*public function data_menu(){
        $user_data=Session::get('ADMIN_DATA');
        $group=AdminAdminRole::getPermissionData($user_data['id']);
        foreach ($group as $k=>$v){
            foreach ($v['permission_role'] as $kk=>$vv){
                $data[$vv['admin_permission_id']] =  Permission::getPermissionCatalog($vv['admin_permission_id']);
                $data_menu[$data[$vv['admin_permission_id']]['parent_id']]=$data[$vv['admin_permission_id']];
            }
        }
        $menu=$this->arrToTree($data_menu,0);
        return $menu;
    }*/
    public function menu_sort($data){
        $count=count($data);
    }

    function arrToTree($data,$pid){
        $tree = array();
        foreach($data as $k => $v){
            if($v['catalog']['parent_id'] == $pid){
                $v['catalog']['parent_id'] = $this->arrToTree($data,$v['catalog']['id']);
                $tree[] = $v;
            }
        }

        return $tree;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
