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
                                <h3 class="box-title">
                                    @if($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                        <li> {{$error}} </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                    {!!Session::get('success')!!}
                                </h3>
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
                          {!! Form::model($show, [ 'method' => 'PATCH', 'class'=>'form-horizontal', 'route' => [$data['update'] , $show->id]]) !!}

                        <div class="box-body">
                            <div class="form-group">
                                <label for="bank" class="col-sm-2 control-label">Bank Name </label>
                                <div class="col-sm-4">
                                    <select name="bank" class="form-control select2m">
                                        <option value="">Select....</option>
                                        @if (count($data['bank']) > 0)
                                        @foreach($data['bank'] as $row)
                                        <option value="{{$row->id}}" @if($show->bank_id == $row->id) {{'selected'}} @endif >  {{$row->name}}  </option>
                                        @endforeach
                                        @endif
                                    </select> 
                                </div>
                                <div class="col-sm-1">
                                    <!-- Small modal -->
                                    <button type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target=".bank-modal">
                                        <i style="margin-top: 2px;" class="fa fa-plus fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-5">
                                    <input name="name" value="{{ $show->name }}" class="form-control" id="name" placeholder="Amount" type="text" required>
                                </div>
                            </div>
                             
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button class="btn btn-primary btn-flat" type="submit">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                SAVE
                            </button>
                        </div>
                        <!-- /.box-footer -->
                        </form>

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
