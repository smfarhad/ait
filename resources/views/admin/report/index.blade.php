@extends('admin.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Discrepancy 
            <small>Asses List </small>
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
                    <div class="box-body">
                        <table id="report_data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SIR</th>
                                    <th>Circle of Deducting Authority</th>
                                    <th>Deducting Authority</th>
                                    <th>Tin</th>
                                    <th>Head</th>
                                    <th>Relevant Date</th>
                                    <th>Amount</th>
                                    <th>Payment Code</th>
                                    
                                     <!--<th>Chalan No</th>-->
                                    <!-- <th>Name Of Beneficiary</th>-->
                                    <!--<th>Created By</th>-->
<!--                                    <th>Bank Name</th>
                                    <th>Branch Name</th>                             -->
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data['main']) > 0)
                                @foreach($data['main'] as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->office}}</td>
                                    <td>{{ ucwords(str_replace ('-', ' ',$row->deduction_authority))}}</td>
                                    <td>{{$row->tin}}</td>
                                    <td>{{$row->head_name}}</td>
                                    <td>{{date('d-m-Y',strtotime($row->chalan_date))}}</td>
                                    <td>{{$row->amount}}</td>
                                    <td>{{$row->payment_code_name}}</td>
                                    
                                    <!--  <td>{{$row->name_of_beneficiary}}</td>-->
                                    <!--   <td>{{$row->chalan_no}}</td>-->
                                    <!--<td>{{$row->created_by_name}}</td>-->
                                    <!-- <td>{{$row->bank_name}}</td>
                                      <td>{{$row->branch_name}}</td>-->
                                </tr>
                                @php
                                    $data['amount_total'] += $row->amount ;
                                @endphp
                                @endforeach 
                                <tr>
                                    <td><span style="display: none;">{{$i}}</span></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                              
                                    <td></td>
                                    <td><b>Total Amount<b></td>
                                    <td><b>{{$data['amount_total']}}</b></td>
                                          <td></td>
                                   
                                    <!--<td></td>-->
<!--                                    <td></td>
                                    <td></td>-->
<!--                                    <td></td>
                                    <td></td>-->

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
