<?php

namespace App\Http\Controllers\F_admin;

use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Module;
use Validator;
use Mail;

class ModuleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $name;
    private $module_id;
    public function __construct() {
        $this->name = 'module';
        $this->module_id = 7;
    }
    
    public function index() {
        $data = array();
        $data['title'] = 'All Module List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Modules';
        $data['cname'] = $this->name;
        $data['destroy'] = "admin.module.destroy";
        $data['table'] = "<th>SIR</th><th>Name</th><th>Username</th><th>Office</th><th>Status</th><th>Process</th>";
        $data['main'] = Db::table('module_register')->get(); 
        $data['i'] = 1;
        return view('admin/module/index')->with('data', $data)->with('disc_list', 1)->with('access', $this->filter());;
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
        $data['office'] = Db::table('office')->get();
        return view('admin/module/create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $random = str_random(30);
        $data = array();
        $data['title'] = 'All Module List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Module';
        
        $input = [];
        $input['name'] = $request->input('name');
        $user = Module::create($input);
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
        $show = Module::findOrFail($id);

        return view('admin.module.show')
                ->with('data', $data)
                ->with('show', $show)
                //->with('hearing', $hearing)
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
        $data['add'] = "Update Module";
        $data['cname'] = $this->name;
        $data['update'] = "admin." . $data['cname'] . ".update";
        $show = Module::findOrFail($id);
        $data['office'] = Db::table('office')->get();
        return view('admin.module.update')->with('data', $data)->with('show', $show)->with('disc_add', 1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $blog = Module::findOrFail($id);
        $input = [];
        $input['name'] = $request->input('name');
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
        Module::destroy($id);
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
