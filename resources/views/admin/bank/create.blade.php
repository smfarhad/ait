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
                        {{ Form::open(array('url' => 'admin/'.$data['cname'], 'class'=>'form-horizontal')) }}

                        <div class="box-body">
                            <div class="form-group">
                                <label for="head" class="col-sm-2 control-label">Head</label>

                                <div class="col-sm-4">
                                    <select name="head" class="form-control select2m" required>
                                        <option value="">Select....</option>
                                        @if (count($data['head']) > 0)
                                        @foreach($data['head'] as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                        @endif
                                    </select> 
                                </div>
                                <div class="col-sm-1">

                                    <!-- Small modal -->
                                    <button type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target=".tax-head-modal">
                                        <i style="margin-top: 2px;" class="fa fa-plus fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-5">
                                    <input name="name" value="{{ old('name') }} " class="form-control" id="name" placeholder="Amount" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tin" class="col-sm-2 control-label">Tin</label>
                                <div class="col-sm-5">
                                    <input name="tin" value="{{ old('tin') }}" class="form-control" id="Tin" placeholder="Tin" data-inputmask="'mask': ['9999-9999-9999']" data-mask type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="col-sm-2 control-label">Amount</label>
                                <div class="col-sm-5">
                                    <input name="amount" value="{{ old('amount') }}" class="form-control" id="amount" placeholder="Amount" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="chalanNo" class="col-sm-2 control-label">Chalan No</label>
                                <div class="col-sm-5">
                                    <input name="chalanNo" value="{{ old('chalanNo') }}" class="form-control" id="chalanNo" placeholder="chalanNo" type="text" required>
                                </div>
                            </div>                           
                            <div class="form-group">
                                <label for="chalanDate" class="col-sm-2 control-label">Chalan Date</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="chalanDate" value="{{ old('chalanDate') }}" class="form-control" id="chalanDate" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask placeholder="DD-MM-YYYY" type="text" required>
                                      </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bank" class="col-sm-2 control-label">Bank Name</label>
                                 <div class="col-sm-4">
                                    <select name="bank" class="form-control select2m">
                                        <option value="">Select....</option>
                                        @if (count($data['bank']) > 0)
                                        @foreach($data['bank'] as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
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
                                <label for="branchName" class="col-sm-2 control-label">Branch Name</label>
                                 <div class="col-sm-4">
                                    <select name="branch" class="form-control select2m">
                                        <option value="">Select....</option>
                                        @if (count($data['branch']) > 0)
                                        @foreach($data['branch'] as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                        @endif
                                    </select> 
                                </div>
                                <div class="col-sm-1">

                                    <!-- Small modal -->
                                    <button type="button" class="btn btn-primary btn-flat pull-right" data-toggle="modal" data-target=".branch-modal">
                                        <i style="margin-top: 2px;" class="fa fa-plus fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="paymentCode" class="col-sm-2 control-label">Payment Code</label>
                                <div class="col-sm-5">
                                    <input name="paymentCode" value="{{ old('paymentCode') }}" class="form-control" id="paymentCode" placeholder="paymentCode" type="text" required>
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
<!-- create head modal body start -->
<div class="modal fade tax-head-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        
        <div class="modal-content">
            <form id="headmodal-form" action="/admin/head" method="post">
                 {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tax Head</h4>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <div class="submit-message text-success">  </div>
                    </div>
                    <div class="form-group">
                       <!--<label for="taxheadName">Head Name</label>-->
                       <input name="taxheadName" type="text" class="form-control" id="taxheadName" placeholder="Tax head " required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
             </form>
        </div>
    </div>
</div>
<!-- create head modal body end -->

<!-- create bank modal body start -->
<div class="modal fade bank-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="bank-form" action="/admin/bank" method="post">
                 {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Bank Name</h4>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <div class="submit-message text-success">  </div>
                    </div>
                    <div class="form-group">
                       <!--<label for="taxheadName">Head Name</label>-->
                       <input name="bankName" type="text" class="form-control" id="taxheadName" placeholder="Bank Name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
             </form>
        </div>
    </div>
</div>
<!-- create head modal bank body end -->
<!-- create Branch modal body start -->
<div class="modal fade branch-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        
        <div class="modal-content">
            <form id="branch-form" action="/admin/branch" method="post">
                 {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tax Head</h4>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <div class="submit-message text-success"> </div>
                    </div>
                    <div class="form-group">
                        <label for="bankName">Bank Name</label>
                        <div>
                            <select name="bank" id="bankName" class="form-control select2" style="width: 100%;" required>
                               <option value="">Select....</option>
                                    @if (count($data['bank']) > 0)
                                    @foreach($data['bank'] as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                       <label for="branchName">Branch Name</label>
                       <input name="branchName" type="text" class="form-control" id="branchName" placeholder="branchName" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
             </form>
        </div>
    </div>
</div>
<!-- create Branch modal bank body end -->
@endsection
