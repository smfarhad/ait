<?php

namespace App\Http\Controllers\F_admin;

use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Hearing;

class HearingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $name;
    private $module_id;
    public function __construct() {
        $this->name = 'hearing';
        $this->module_id = 6;
    }

    public function index() {
        $data = array();
        $data['title'] = 'All Descrepancy List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Descrepancy';
        $data['cname'] = $this->name;
        $data['destroy'] = "admin." . $data['cname'] . ".destroy";
        $data['table'] = "<th>SIR</th><th>Name</th><th>Tin</th><th>Office</th><th>Process</th>";
        $data['discrepancy'] = Discrepancy::latest()->get();
        //$data['discrepancy'] =  DB::table('discrepancy')->where('name', 'John')->value('email');;
        $data['i'] = 1;
        return view('admin/discrepancy/index')->with('data', $data)->with('access', $this->filter());;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = array();
        $data['title'] = 'All Hearing List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Hearing';
        $data['cname'] = $this->name;
        return view('admin/discrepancy/create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        //return $request->all();
        $data = array();
        $data['title'] = "All". ucfirst($this->name) ;
        $data['list'] = 'Dashboard';
        $data['add'] = "Add New". ucfirst($this->name) ;

        $input = [];
        $input['hearing_date']    = $request->input('hearingDate');
        $input['place']           = $request->input('place');
        $input['discrepancy_id']  = $request->input('discrepancyId');
        $input['created_by']      = Auth::user()->id;
        if (!$input['id']             = $request->input('id')) {
            Hearing::create($input);
        } else {
            DB::table('hearings')
                    ->where('id', $input['id'])
                    ->update($input);
        }
        Session::flash('success', "<span class=text-green> &nbsp; &nbsp; Data Inserted Successfully </span>");
        return back()->withInput($request->input());
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
        $show = Discrepancy::findOrFail($id);
        return view('admin.discrepancy.show')->with('data', $data)->with('show', $show);
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
        $data['add'] = "Update $this->name";
        $data['cname'] = $this->name;
        $data['update'] = "admin." . $data['cname'] . ".update";
        $show = Hearing::findOrFail($id);
        return view('admin.discrepancy.update')->with('data', $data)->with('show', $show);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $blog = Discrepancy::findOrFail($id);
        $input = [];
        $input['name'] = $request->input('name');
        $input['tin'] = str_replace('-', '', $request->input('tin'));
        $input['comments'] = $request->input('comments');
        $input['updated_by'] = Auth::user()->id;
        $input['updated_at'] = date('Y-m-d H:i:s');
        $input['office_id'] = Auth::user()->office_id;
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
        Hearing::destroy($id);
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
