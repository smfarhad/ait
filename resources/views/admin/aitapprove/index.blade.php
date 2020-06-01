@extends('admin.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ucfirst( $data['cname'] )}}
            <small>List </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-success">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title"> {!!Session::get('success')!!}</h3>
                            </div>
                            <div class="col-md-6 text-right text-bold">
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="list_data_table" class="table table-bordered table-striped">
                            <thead>
                                
                                <tr style="background: #F9F9F9;">
                                    <th>SIR</th>
                                    <th style="width:70px;" >Process</th>
                                    <th>Circle of Deducting Authority</th>
                                    <th>Deduction Authority</th>
                                    <th>Tin</th>
                                    <th>Head</th>
                                    <th>Relevant Date</th>
                                    <th>Amount</th>   
                                    <th>Payment Code</th>                          
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data['main']) > 0)
                                @foreach($data['main'] as $row)
                                <tr>
                                    <td>{{$data['i']++}}</td>
                                    <td>
                                        @if($access['edit'] == 1)
                                        <a class=" text-bold btn btn-warning btn-xs" href="{{URL::to('admin/'.$data['cname'] .'/'. $row->id . '/edit')}}"> <i class="fa fa-pencil " aria-hidden="true"></i></a>
                                        @endif
                                        @if($row->status == 1)
                                        <button class=" text-bold btn btn-success btn-xs"> <i class="fa fa-check " aria-hidden="true"></i></button>
                                        @else
                                        <button class=" text-bold btn btn-danger btn-xs"> <i class="fa fa-check " aria-hidden="true"></i></button>        
                                        @endif
                                    </td> 
                                    <td>{{$row->office}}</td>
                                    <td>{{$row->deduction_authority}}</td>
                                    <td>{{$row->tin}}</td>
                                    <td>{{$row->head_name}}</td>
                                    <td>{{date('d-m-Y',strtotime($row->chalan_date))}}</td>
                                    <td>{{$row->amount}}</td>
                                    
                                    <td>{{$row->payment_code_name}}</td>
                                    
                                    
                                    
                                </tr>
                                @php
                                    $data['amount_total'] += $row->amount ;
                                @endphp
                                @endforeach 
                                <tr>
                                    <td>{{$data['i']}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total Amount<b></td>
                                    <td><b>{{$data['amount_total']}}<b></td>                                    
                                    <td></td>
                                </tr>
                                @else
                                @endif
                            </tbody>
                          
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection
