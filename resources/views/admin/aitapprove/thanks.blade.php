@extends('admin.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ucfirst( $data['cname'] )}}
            <small>Add</small>
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
                               
                            </div>
                            <div class="col-md-6 text-right text-bold">
                                <a href="{{ URL::to('admin/'.$data['cname'])}}">
                                    <button class="btn btn-primary btn-flat" type="button">
                                        <i class="fa fa-eye" aria-hidden="true"></i> VIEW LIST
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body text-center">
                            
                            <h1 class="box-title">
                                @if($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                    <li> {{$error}} </li>
                                    @endforeach
                                </ul>
                                @endif
                                {!!Session::get('success')!!}
                            </h1>
                           
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <a href="{{url('/admin/ait/create')}}" class="btn btn-primary btn-flat">
                                        
                                        INSERT AGAIN
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{url('admin/ait')}}" class="btn btn-primary btn-flat" type="submit">
                                        
                                       VIEW INSERTED DATA
                                    </a>
                                </div>
                            </div>
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
