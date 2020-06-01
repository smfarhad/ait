<?php

namespace App\Http\Controllers\F_admin;

use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\PaymentCode;

class PaymentcodeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $name;
    private $office_id;
    private $parent_id;
    private $module_id;
    public function __construct() {
        $this->name = 'paymentcode';
        $this->office_id = Auth::user()->office_id;
        $this->module_id = 9;
    }

    public function index() {
        $data = array();
        $data['title'] = 'All Payment Code List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Payment Code';
        $data['cname'] = $this->name;
        $data['destroy'] = "admin." . $data['cname'] . ".destroy";
        $data['main'] = PaymentCode::get();
        $data['i'] = 1;
        return view('admin/paymentcode/index')->with('data', $data)->with('disc_list', 1)->with('access', $this->filter());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = array();
        $data['title'] = 'Add New Payment Code';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Payment Code';
        $data['cname'] = $this->name;
        $data['head'] = PaymentCode::where('status', 1)->get();
        return view('admin/paymentcode/create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = array();
        $data['title'] = 'All Paymentcode List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Paymentcode';
        
        $input = [];
        $input['name']          = $request->input('name');
        $input['status']        = 1;
        $input['created_by']    = Auth::user()->id;        
        PaymentCode::create($input);
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
        $data['title'] = "All $this->name Lsit";
        $data['list'] = 'Dashboard';
        $data['add'] = "Add New $this->name ";
        $data['cname'] = $this->name;
        $show = PaymentCode::first();
        return view("admin.".$data['cname'].".show")
                        ->with('data', $data)
                        ->with('show', $show)
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
        $data['title'] = "Edit ". ucfirst($this->name);
        $data['list'] = 'Dashboard';
        $data['add'] = "Update". ucfirst($this->name) ;
        $data['cname'] = $this->name;
        $data['update'] = "admin." . $data['cname'] . ".update";
        $show = PaymentCode::findOrFail($id);
        return view("admin.".$data['cname'].".update")->with('data', $data)->with('show', $show)->with('disc_add', 1);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $input = [];
        $input['name']       = $request->input('name');
        $input['status']     = 1;
        $input['created_by'] = Auth::user()->id;       
        
        $head = PaymentCode::findOrFail($id);
        $head->update($input);
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
        PaymentCode::destroy($id);
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
