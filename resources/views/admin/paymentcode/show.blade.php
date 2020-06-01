@extends('admin.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ucfirst( $data['cname'] )}} <small> Details </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Add New</a></li>
            <li class="active">Discrepancy</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title">{!!Session::get('success')!!}</h3>
                            </div>
                            <div class="col-md-6 text-right text-bold">
                                <a href="{{ URL::to('admin/'.$data['cname'])}}">
                                    <button class="btn btn-primary btn-flat" type="button">
                                        <i class="fa fa-eye" aria-hidden="true"></i> VIEW LIST
                                    </button>
                                </a> &nbsp;
                                <a class="text-bold" href="{{URL::to('admin/'.$data['cname'].'/'. $show->id . '/edit')}}">
                                    <button class="btn btn-warning btn-flat" type="button">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> EDIT DATA
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                 
                                    <div class="col-md-12">
                                        <label for="name" class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-5">
                                            {{ $show->name }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="comments" class="col-sm-3 control-label"> Create Date </label>
                                        <div class="col-sm-5">
                                            {{ date("d/m/Y", strtotime($show->created_at)) }}
                                        </div>
                                    </div>
                                                                    
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-right">
                    </div>
                    <!-- /.box-footer -->
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
