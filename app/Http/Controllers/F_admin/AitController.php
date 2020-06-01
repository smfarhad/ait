<?php

namespace App\Http\Controllers\F_admin;

use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ait;
use App\Models\Head;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Office;
use App\Models\PaymentCode;

class AitController extends Controller {

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
        $this->name = 'ait';
        $this->module_id = 2;
        $this->office_id = Auth::user()->office_id;
        
    }

    public function index() {
        
        $data = array();
        $data['title'] = 'All Ait List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Ait';
        $data['cname'] = $this->name;
        $data['amount_total'] = 0;
        $data['destroy'] = "admin." . $data['cname'] . ".destroy";
        
        $office = DB::table('office')
                    ->select('parent_id')
                    ->where('id', $this->office_id)
                    ->get();
        if(count($office) > 0) {
            $this->parent_id = $office[0]->parent_id;
        } else {
            $this->parent_id = '';
        }
        if ($this->parent_id) {
            $office = DB::table('office')
                    ->select('id')
                    ->where('id', $this->office_id)
                    ->orWhere('parent_id', $this->office_id)
                    ->get();
            $office_array = [];
            $i = 0;
            foreach ($office as $row) {
                $office_array[$i] = $row->id;
                $i++;
            }

            $data['main'] = DB::table('ait as a')
                    ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                    ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                    ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                    ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                    ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                    ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                    ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                    ->whereIn('a.office_id', $office_array)
                    //->where('a.status', 0)
                    ->get();
        } else {
            $data['main'] = DB::table('ait as a')
                    ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                    ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                    ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                    ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                    ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                    ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                    
                    ->select('a.*', 'o.name as office', 'b.name as bank_name', 'p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                    //->where('a.status', 0)
                    ->get();
        }

        $data['i'] = 1;
        return view('admin/ait/index')->with('data', $data)->with('disc_list', 1)->with('access', $this->filter());
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = array();
        $data['title'] = 'Add New Ait';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Ait';
        $data['cname'] = $this->name;
        $data['head'] = Head::where('status', 1)->get();
        $data['bank'] = Bank::where('status', 1)->get();
        $data['branch'] = Branch::where('status', 1)->get();
        $data['office'] = Office::where('parent_id','>', 1)->get();
        $data['paymentCode'] = PaymentCode::get();
        
        return view('admin/ait/create')->with('data', $data);
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
        $data['title'] = 'All Office List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Office';

        $input = [];
        $deduction_authority_raw = str_replace(" ","-",strtolower($request->input('deductionAuthority')));
        $input['deduction_authority'] = $deduction_authority_raw;
        $input['office_id'] = $request->input('circleOfDeductionAuthority');
        $input['head_id'] = $request->input('head');
        $input['tin'] = str_replace('-', '', $request->input('tin'));
        $input['amount'] = $request->input('amount');
        $input['chalan_no'] = $request->input('chalanNo');
        
        $chalan_date_raw = explode("-",$request->input('chalanDate'));
        $chalan_date = $chalan_date_raw[2].'-'.$chalan_date_raw[1].'-'.$chalan_date_raw[0];
        $input['chalan_date'] = $chalan_date;
        
        $input['bank_id'] = $request->input('bank');
        $input['branch_id'] = $request->input('branch');
        $input['payment_code'] = $request->input('paymentCode');
        $input['created_by'] = Auth::user()->id;
        //$input['office_id'] = Auth::user()->office_id;
        $input['status'] = 0; 
        $where = ['tin' => $input['tin']];

        $ait = DB::table('ait')
                ->select(DB::raw('YEAR(created_at) year'))
                ->where($where)
                ->whereYear('created_at', '=', date('Y'))
                ->get();

        
            Ait::create($input);
            Session::flash('success', "<span class=text-green> &nbsp; &nbsp; Data Inserted Successfully </span>");
              return redirect('/thanks');
            http://ait.dev/thanks
            //return back()->withInput($request->input())->with('disc_add', 1);
//        } else {
//            Session::flash('success', "<span class=text-yellow> &nbsp; &nbsp; This TIN already inserted</span>");
//             return redirect('/thanks');
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
        $data['add'] = 'Add New Descrepancy';
        $data['cname'] = $this->name;

        $show = DB::table('ait as a')
                    ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                    ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                    ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                    ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                    ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                    ->select('a.*', 'o.name as office', 'b.name as bank_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                    ->first();
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
        $data['title'] = 'Edit Ait';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Update AIT';
        $data['cname'] = $this->name;
        $data['update'] = "admin." . $data['cname'] . ".update";
        $data['head'] = Head::where('status', 1)->get();
        $data['bank'] = Bank::where('status', 1)->get();
        $data['branch'] = Branch::where('status', 1)->get();
        $data['office'] = Office::where('parent_id','>', 1)->get();
        $data['paymentCode'] = PaymentCode::get();
        $show = Ait::findOrFail($id);
        $office = DB::table('office')
                    ->select('parent_id')
                    ->where('id', $this->office_id)
                    ->get();
        if(count($office) > 0) {
            $this->parent_id = $office[0]->parent_id;
        } else {
            $this->parent_id = '';
        }
        if ($this->parent_id) {
            $office = DB::table('office')
                    ->select('id')
                    ->where('id', $this->office_id)
                    ->orWhere('parent_id', $this->office_id)
                    ->get();
            $office_array = [];
            $i = 0;
            foreach ($office as $row) {
                $office_array[$i] = $row->id;
                $i++;
            }

            $data['main'] = DB::table('ait as a')
                    ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                    ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                    ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                    ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                    ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                    ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                    ->select('a.*', 'o.name as office', 'b.name as bank_name','p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                    ->whereIn('a.office_id', $office_array)
                    //->where('a.status', 0)
                    ->get();
        } else {
            $data['main'] = DB::table('ait as a')
                    ->leftJoin('head as h', 'a.head_id', '=', 'h.id')
                    ->leftJoin('office as o', 'a.office_id', '=', 'o.id')
                    ->leftJoin('bank as b', 'a.bank_id', '=', 'b.id')
                    ->leftJoin('branch as br', 'a.branch_id', '=', 'br.id')
                    ->leftJoin('users as u', 'a.created_by', '=', 'u.id')
                    ->leftJoin('payment_code as p', 'a.payment_code', '=', 'p.id')
                    ->select('a.*', 'o.name as office', 'b.name as bank_name', 'p.name as payment_code_name', 'br.name as branch_name', 'h.name as head_name', 'u.name as created_by_name')
                    //->where('a.status', 0)
                    ->get();
        }
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
        //return $request->all(); 
        //
        $ait = Ait::findOrFail($id);
        $input = [];
        $input['deduction_authority'] = str_replace(" ","-",strtolower($request->input('deductionAuthority')));
        $input['office_id'] = $request->input('circleOfDeductionAuthority');
        $input['head_id'] = $request->input('head');
        $input['tin'] = str_replace('-', '', $request->input('tin'));
        $input['amount'] = $request->input('amount');
                        
        $chalan_date_raw = explode("-",$request->input('chalanDate'));
        $chalan_date = $chalan_date_raw[2].'-'.$chalan_date_raw[1].'-'.$chalan_date_raw[0];
        $input['chalan_date'] = $chalan_date;
        //$input['bank_id'] = $request->input('bank');
        //$input['branch_id'] = $request->input('branch');
        $input['payment_code'] = $request->input('paymentCode');
        //$input['created_by'] = Auth::user()->id;
        //$input['office_id'] = Auth::user()->office_id;
    
        $ait->update($input);
        
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
        Ait::destroy($id);
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
