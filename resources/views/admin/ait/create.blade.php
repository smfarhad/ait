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
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- First Section Start -->
                                    <div class="form-group">
                                        <label for="head" class="col-sm-4 control-label">Circle of Deducting Authority</label>
                                        <div class="col-sm-8">
                                            <select name="circleOfDeductionAuthority" class="form-control select2m" required>
                                                <option value="">Select A Circle ....</option>
                                                @if (count($data['office']) > 0)
                                                @foreach($data['office'] as $row)
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                                @endif
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="deductionAuthority" class="col-sm-4 control-label">Name Of Deducting Authority</label>
                                        <div class="col-sm-8">
                                            <input name="deductionAuthority" value="" class="form-control" id="deductionAuthority" placeholder="Deduction Authority" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tin" class="col-sm-4 control-label">TIN Of Deducting Authority</label>
                                        <div class="col-sm-8">
                                            <input name="tin" value="" class="form-control" id="Tin" placeholder="TIN Of Deducting Authority" data-inputmask="'mask': ['9999-9999-9999']" data-mask type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="head" class="col-sm-4 control-label">Heads Of TDS</label>

                                        <div class="col-sm-8">
                                            <select name="head" class="form-control select2m" required>
                                                <option value="">Select A Head....</option>
                                                @if (count($data['head']) > 0)
                                                @foreach($data['head'] as $row)
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                                @endif
                                            </select> 
                                        </div>
                                       
                                    </div>
                               
<!--                                <div class="form-group">
                                        <label for="nameOfBeneficiary" class="col-sm-4 control-label"> Name Of Beneficiary </label>
                                        <div class="col-sm-8">
                                            <input name="nameOfBeneficiary" value="" class="form-control" id="name" placeholder="Name Of Beneficiary" type="text" required>
                                        </div>
                                    </div>-->
                                                 
                                    

                                    <!-- First Section End -->
                                </div>
                                <div class="col-md-6">
                                    
                                    <!-- Second Section Start -->
                                         <div class="form-group">
                                        <label for="chalanDate" class="col-sm-4 control-label">Relevant Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input name="chalanDate" value="" class="form-control" id="chalanDate" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask placeholder="dd-mm-yyyy" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount" class="col-sm-4 control-label">Amount</label>
                                        <div class="col-sm-8">
                                            <input name="amount" value="" class="form-control" id="amount" placeholder="Amount" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="paymentCode" class="col-sm-4 control-label">Payment Code</label>
                                        <div class="col-sm-7">
                                            <select name="paymentCode" class="form-control select2m">
                                                <option value="">Select....</option>
                                                @if (count($data['paymentCode']) > 0)
                                                @foreach($data['paymentCode'] as $row)
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                                @endif
                                            </select> 
                                        </div>
                                        
                                    </div>
<!--                                    <div class="form-group">
                                        <label for="chalanNo" class="col-sm-4 control-label">Chalan No</label>
                                        <div class="col-sm-8">
                                            <input name="chalanNo" value="" class="form-control" id="chalanNo" placeholder="chalanNo" type="text" required>
                                        </div>
                                    </div>                           -->
                                    

<!--                                    <div class="form-group">
                                        <label for="bank" class="col-sm-4 control-label">Bank Name</label>
                                        <div class="col-sm-8">
                                            <select id="bank" name="bank" class="form-control select2m">         
                                                <option value="">Select....</option>
                                                @if (count($data['bank']) > 0)
                                                @foreach($data['bank'] as $row)
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                                @endif
                                            </select> 
                                        </div>
                                        
                                    </div>-->

<!--                                    <div class="form-group">
                                        <label for="branchName" class="col-sm-4 control-label">Branch Name</label>
                                        <div class="col-sm-8">
                                            <select id="branch" name="branch" class="form-control" >
                                            
                                                <option value="">Select....</option>
                                                @if (count($data['branch']) > 0)
                                                @foreach($data['branch'] as $row)
                                                <option data-bank="{{$row->bank_id}}"  value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                                @endif
                                            </select> 
                                        </div>
                                        
                                    </div>-->

                                    

                                    <!-- Second Section End -->
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
