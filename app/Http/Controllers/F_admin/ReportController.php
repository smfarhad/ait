<?php

namespace App\Http\Controllers\f_admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Session;
use App\models\Office;
use App\models\Head;

class ReportController extends Controller {

    private $name;
    private $office_id;
    private $parent_id;
    private $module_id;
    public function __construct() {
        $this->name = 'report';
        $this->office_id = Auth::user()->office_id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = array();
        $data['title'] = 'All Report';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Generate A Report';
        $data['cname'] = $this->name;
        $data['head'] = Head::get();
        $data['office'] = $this->office();
        return view("admin/" . $this->name . "/create")->with('data', $data)->with('access', $this->filter());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $data = array();
        $data['title'] = [];
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Report';
        $data['cname'] = $this->name;
        $data['office'] = Office::get();
        $data['head'] = Head::get();
        $data['amount_total'] = 0;
        
        $input = [];
        $input['office'] = $request->input('office');
        $input['head'] = $request->input('head');
        $input['tin'] = str_replace('-', '', $request->input('tin'));
        $input['deduction_authority'] =  str_replace(" ","-",strtolower($request->input('deductionAuthority')));
        $input['date'] = explode(" ", $request->input('date'));      
        
        if ($input['office'] == 1) {
            
            // commissionar office user 
            if($input['head']){
                    $data['main'] = DB::table('ait as a')
                    ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                    ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                    ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                    ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                    ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                    ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                    ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                    ->where('a.head_id', $input['head'])
                    ->where('a.status', 1)
                    ->get();
            }elseif($input['tin']){
                    $data['main'] = DB::table('ait as a')
                                ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                                ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                                ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                                ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                                ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                                ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                                ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                                ->where('a.tin', $input['tin'])
                                ->where('a.status', 1)
                                ->get();
            }elseif($input['deduction_authority']){
                    $data['main'] = DB::table('ait as a')
                                ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                                ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                                ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                                ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                                ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                                ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                                ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                                ->where('a.deduction_authority', $input['deduction_authority'])
                                ->where('a.status', 1)
                                ->get();
            }elseif( count($input['date']) > 1) {
                
                    $from_raw = explode("-",date($input['date'][0]));
                    $from = $from_raw[2].'-'.$from_raw[1].'-'.$from_raw[0];
                        
                    $to_raw = explode("-",date($input['date'][2]));
                    $to = $to_raw[2].'-'.$to_raw[1].'-'.$to_raw[0];   
                    
                    $data['main'] = DB::table('ait as a')
                                ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                                ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                                ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                                ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                                ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                                ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                                ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                                ->orWhereBetween('chalan_date', [$from, $to])
                                ->where('a.status', 1)
                                ->get();                 
            }else{
               
                $data['main'] = DB::table('ait as a')
                                    ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                                    ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                                    ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                                    ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                                    ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                                    ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                                ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')      
                        ->where('a.status', 1)
                                    ->get();
            }
    }else {
            $office = DB::table('office')
                    ->select('parent_id')
                    ->where('id', $request->input('office'))
                    ->first();
            
            if ($office->parent_id == 1) {
                $office = DB::table('office')
                        ->select('id')
                        ->orWhere('id', $request->input('office'))
                        ->orWhere('parent_id', $request->input('office'))
                        ->get();
                $i = 0;
                $office_id = [];
                foreach ($office as $row) {
                    $office_id[$i] = $row->id;
                    $i++;
                }
                // range data
                if($input['head']){
                $data['main'] = DB::table('ait as a')
                        ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                        ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                        ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                        ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                        ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                        ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                        ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                        ->whereIn('a.office_id', $office_id)
                        ->where('a.head_id', $input['head'])
                        ->where('a.status', 1)
                        ->get();
                }elseif($input['tin']){
                    $data['main'] = DB::table('ait as a')
                        ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                        ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                        ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                        ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                        ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                        ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                        ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                        ->whereIn('a.office_id', $office_id)
                        ->where('a.tin', $input['tin'])
                        ->where('a.status', 1)
                        ->get();
               }elseif($input['deduction_authority']){
                    $data['main'] = DB::table('ait as a')
                                ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                                ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                                ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                                ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                                ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                                ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                                ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                                ->where('a.deduction_authority', $input['deduction_authority'])
                                ->where('a.status', 1)
                                ->get();
                }elseif( count($input['date']) > 1) {
                    $from = date($input['date'][0]);
                    $to = date($input['date'][2]);
                    $data['main'] = DB::table('ait as a')
                        ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                        ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                        ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                        ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                        ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                        ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                        ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                        ->whereIn('a.office_id', $office_id)
                        ->orWhereBetween('chalan_date', [$from, $to])
                        ->where('a.status', 1)
                        ->get();
                }else {
                    $data['main'] = DB::table('ait as a')
                        ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                        ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                        ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                        ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                        ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                        ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                        ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
              
                        ->whereIn('a.office_id', $office_id)
                        ->where('a.status', 1)
                        ->get();
                }
            } else {
                // circle data
                if($input['head']){
                        $data['main'] = DB::table('ait as a')
                        ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                        ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                        ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                        ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                        ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                        ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                        ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                             
                        ->where('a.office_id', $request->input('office'))
                        ->where('a.head_id', $input['head'])
                        ->where('a.status', 1)
                        ->get();
                                       
                }
                elseif($input['deduction_authority']){
                    $data['main'] = DB::table('ait as a')
                                ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                                ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                                ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                                ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                                ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                                ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                                ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                                ->where('a.deduction_authority', $input['deduction_authority'])
                                ->where('a.status', 1)
                                ->get();
                }
                elseif($input['tin']){
                    $data['main'] = DB::table('ait as a')
                        ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                        ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                        ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                        ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                        ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                        ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                        ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                        ->where('a.office_id', $request->input('office'))
                        ->where('a.tin', $input['tin'])
                        ->where('a.status', 1)
                        ->get();                    
                } elseif( count($input['date']) > 1) {
                    $from = date($input['date'][0]);
                    $to = date($input['date'][2]);   
                    $data['main'] = DB::table('ait as a')
                        ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                        ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                        ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                        ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                        ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                        ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                        ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                        ->where('a.office_id', $request->input('office'))
                        ->orWhereBetween('chalan_date', [$from, $to])
                        ->where('a.status', 1)
                        ->get();
                }else{
                    $data['main'] = DB::table('ait as a')
                        ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                        ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                        ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                        ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                        ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                        ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                        ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                        ->where('a.office_id', $request->input('office'))
                        ->where('a.status', 1)
                        ->get();
                }
            }
        }
        
        if($input['office'] == null || $input['office'] == 1){
                     
           $data['title']['office'] = 'By Commissioner Office';
           
        } else {
          
         $data['title']['office'] = DB::table('office')
                                ->where('id', $request->input('office'))
                                ->first()->name;
        }
        
        if($input['head'] > 0){
            $data['title']['head'] ='By Head : '.DB::table('head')
                                ->where('id', $request->input('head'))
                                ->first()->name;
        }
        
        if($input['tin'] > 0){
            $data['title']['tin'] = 'By Tin : '. $input['tin'];
        }
        
        if(count($input['date'])>1){
           $data['title']['date'] = 'By Date : '. $request->input('date');
        }
        return view("admin/" . $this->name . "/index")
                ->with('data', $data)
                ->with('i', 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function office() {
        $office = Office::get();
        $circle = [];
        $i = 1;

        foreach ($office as $row) {
            if ($row->parent_id == null) {
                $commissionar_id = $row->id;
            }
            if ($this->office_id == $commissionar_id) {
                $office = $office;
            } elseif ($row->parent_id == $this->office_id) {
                $circle[0] = $this->office_id;
                $circle[$i] = $row->id;
                $i++;
            } else {
                $circle[0] = $this->office_id;
            }
        }

        if (count($circle)) {
            $office = Office::whereIn('id', $circle)->get();
            ;
        }
        return $office;
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
