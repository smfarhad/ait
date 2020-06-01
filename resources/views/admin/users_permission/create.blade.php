@extends('admin.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users 
            <small>New</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Add New</a></li>
            <li class="active">User</li>
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
                                    <ul style="padding-left: 30px;" class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                        <li> {{$error}} </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                   {!!Session::get('success')!!}
                                </h3>
                            </div>
                            <div class="col-md-6 text-right text-bold">
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- /.box-header -->
                        <!-- form start -->
                        {{ Form::open(array('url' => 'admin/'.$data['cname'], 'class'=>'form-horizontal')) }}
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="office" class="col-sm-2 control-label">User</label>
                                <div class="col-sm-3">
                                    <select name="user" class="form-control" required>
                                        <option value="">Select..</option>
                                        @if(count($data['users'])>0)
                                            @foreach($data['users'] as $row )
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                           @php ($i = 0)
                            @if(count($data['module'])>0)
                            
                                @foreach($data['module'] as $row)
                                    <div class="form-group col-md-12">
                                        <div class="form-group col-sm-3">
                                            <label for="inputEmail" class="col-sm-12 control-label">{{$row->name}}</label>
                                            <input type="hidden" name="module[]" class="form-control" id="module" value="{{$row->id}}">
                                        </div>
                                        <label style="heigh:50px; margin-left:50px;" for="read" class=" control-label">Read</label>
                                        <label><input name="read[]" type="checkbox" value="{{$row->id}}" class="minimal"></label>
                                        
                                        <label style="heigh:50px; margin-left:40px;" for="write" value="1" class=" control-label">Write</label>
                                        <label><input name="write[]" type="checkbox" value="{{$row->id}}" class="minimal"></label>
                                        
                                        <label style="heigh:50px; margin-left:50px;" for="edit" class=" control-label">Edit</label>
                                        <label><input name="edit[]" type="checkbox" value="{{$row->id}}" class="minimal"></label>
                                        
                                        <label style="heigh:50px; margin-left:40px;" for="delete" class=" control-label">Delete</label>
                                        <label><input name="delete[]" type="checkbox" value="{{$row->id}}" class="minimal"></label>
                                    </div> 
                                @php
                                      $i++
                                @endphp
                                @endforeach
                            @endif
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
