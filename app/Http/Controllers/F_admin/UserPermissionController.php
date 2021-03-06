<?php

namespace App\Http\Controllers\F_admin;

use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\admin\UsersRequest;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\UserPermission;
use Validator;
use Mail;

class UserPermissionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $name;
    private $module_id;
    
    public function __construct() {
        $this->name = 'users_permission';

    }
    
    public function index() {
        $data = array();
        $data['title'] = 'All Users Permission List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New User Permission';
        $data['cname'] = 'users_permission';
        $data['destroy'] = "admin." . $data['cname'] . ".destroy";
        $data['table'] = "<th>SIR</th><th>Name</th><th>Username</th><th>Office</th><th>Status</th><th>Process</th>";
        $data['users'] = Db::table('users')
                            ->leftJoin('office as o', 'users.office_id', '=', 'o.id')
                            ->select('users.*', 'o.name as office_name')
                            ->where('user_type','<>',1)->get(); 
        $data['i'] = 1;
        return view('admin/users_permission/index')->with('data', $data)->with('disc_list', 1)->with('access', $this->filter());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = array();
        $data['title'] = "All $this->name List";
        $data['list'] = 'Dashboard';
        $data['add'] = "Add New $this->name";
        $data['cname'] = $this->name;
        $data['users'] = Db::table('users')->get();
        $data['module'] = Db::table('module_register')->get();
        return view('admin/users_permission/create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $permission = $request->all();
        $input = []; 
        $module = [];
        foreach($permission['module'] as $key=>$val){
            $input[$val]['user_id'] = $permission['user'];
            $input[$val]['module_id']=$val;
            $input[$val]['read_access']=0;
            $input[$val]['write_access']=0;
            $input[$val]['edit_access']=0;
            $input[$val]['delete_access']=0;
            
            if(isset($permission['read'])){
                foreach($permission['read'] as $key=>$val){
                    $input[$val]['read_access']=1;
                }
            }
            if(isset($permission['write'])){
                foreach($permission['write'] as $key=>$val){
                    $input[$val]['write_access']=1;
                }
            }
            if(isset($permission['edit'])){
                foreach($permission['edit'] as $key=>$val){
                    $input[$val]['edit_access']=1;
                }
            }
            if(isset($permission['delete'])){
                foreach($permission['delete'] as $key=>$val){
                    $input[$val]['delete_access']=1;
                }
            }
        }
        UserPermission::where('user_id',$permission['user'] )->delete();
        $data = array();
        $data['title'] = 'All User Permission List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Users Permission';
       $user = UserPermission::insert(array_values($input));
                                     
        Session::flash('success', "<span class=text-green> &nbsp; &nbsp; Data Inserted Successfully </span>");
        return back()->withInput($request->input())->with('disc_add', 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) { 
        $data = array();
        $data['title'] = "All $this->name List";
        $data['list'] = 'Dashboard';
        $data['add'] = "Add New $this->name";
        $data['cname'] = $this->name;
        $show = Users::findOrFail($id);
        $hearing = DB::table('hearings')->where('discrepancy_id',$id)->orderBy('hearing_date', 'desc')->get();
        //dd($hearing);
        return view('admin.users_permission.show')
                ->with('data', $data)
                ->with('show', $show)
                ->with('hearing', $hearing)
                ->with('i', 1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = array();
        $data['title'] = "All $this->name List";
        $data['list'] = 'Dashboard';
        $data['add'] = "Update Users Permission";
        $data['cname'] = $this->name;
        $data['update'] = "admin." . $data['cname'] . ".update";
        $show = Users::findOrFail($id);
        $data['office'] = Db::table('office')->get();
        return view('admin.users_permission.update')->with('data', $data)->with('show', $show)->with('disc_add', 1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $blog = Users::findOrFail($id);
        
        $input = [];
        $input['name'] = $request->input('name');
        $input['username'] = trim($request->input('username'));
        $input['password'] = trim(bcrypt($request->input('password')));
        $input['office_id'] = $request->input('office');
        $input['user_type'] = 2;
        $input['is_activated'] = $request->input('status');
        $input['updated_by'] = Auth::user()->id;
        $input['updated_at'] = date('Y-m-d H:i:s');
        
        
        $blog->update($input);
        
        Session::flash('success', "<span class=text-green> &nbsp; &nbsp; Data Updated Successfully</span>");
        return back()->withInput($request->input());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Users::destroy($id);
        Session::flash('success', "<span class=text-yellow> &nbsp; &nbsp; Data Deleted Successfully </span>");
        return redirect()->back();
    }
    public function filter() {
        $permit = [];
        $permission = session()->get('permission');
        foreach ($permission as $row) {
            if($row->module_id == $this->module_id){
                $permit['read'] = $row->read_access;
                $permit['write'] = $row->write_access;
                $permit['edit'] = $row->write_access;
                $permit['delete'] =$row->delete_access;
            }
        }
        return $permit;
    }

    
}
