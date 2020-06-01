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
                                @if($access['write'] == 1)
                                    <a href="{{URL::to("admin/".$data['cname']."/create")}}">
                                        <button class="btn btn-primary btn-flat" type="button">
                                            <i class="fa fa-plus" aria-hidden="true"></i> ADD NEW
                                        </button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="list_data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SIR</th>
                                    <th>Bank</th>
                                    <th>Name</th>
                                                             
                                    
                                    <th style="width:70px;" >Process</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data['main']) > 0)
                                @foreach($data['main'] as $row)
                                <tr>
                                    <td>{{$data['i']++}}</td>
                                    <td>{{$row->bank_name}}</td>
                                    <td>{{$row->name}}</td>
                                  
                                    <td>
                                        <a class=" text-bold btn btn-primary btn-xs" href="{{URL::to('admin/'.$data['cname'], [$row->id])}}"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                        @if($access['edit'] == 1)
                                        <a class=" text-bold btn btn-warning btn-xs" href="{{URL::to('admin/'.$data['cname'] .'/'. $row->id . '/edit')}}"> <i class="fa fa-pencil " aria-hidden="true"></i></a>
                                        @endif
                                        @if($access['delete'] == 1)
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal{{$row->id}}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                        @endif 

                                        <!-- Modal -->
                                        <div class="modal fade modal-danger" id="myModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                        Are you sure you want to delete this Post?                 
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button> &nbsp;
                       
                                                        {!! Form::open(['method' => 'DELETE','route' => [$data['destroy'], $row->id], 'style'=>'display:inline;']) !!}
                                                        <button type="submit" class="btn btn-outline btn-danger pull-right delete-confirm">Yes, Delete This Post</button>   
                                                        {!! Form::close() !!} 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td> 
                                </tr>
                                @endforeach 
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
