<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserPermission;

class HomeController extends Controller
{
    
    private $name;
    private $office_id;
    private $parent_id;


    public function __construct() {
        $this->middleware('auth');
        $this->name = 'Home';
        $this->module_id = 1;
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return session()->get('permission') ;
        $data = array();
        $data['title'] = 'Dashboard';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Ait';
        $data['cname'] = $this->name;

        return view('admin.home')
                ->with('title',$data['title'])
                ->with('data', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo 'create';
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
    public function thanks() {
        $data = array();
        $data['title'] = 'All Ait List';
        $data['list'] = 'Dashboard';
        $data['add'] = 'Add New Ait';
        $data['cname'] = $this->name;
        $data['amount_total'] = 0;
        $data['destroy'] = "admin." . $data['cname'] . ".destroy";
        return view('admin.ait.thanks')
                ->with('title',$data['title'])
                ->with('data', $data);
    }  

}
