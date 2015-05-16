
@extends('layouts.main')

@section('title')
    Accounts Management
@stop

@section('main')


<div class="row">
     @if(Session::get('msgsuccess'))
      <div class="alert alert-success fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgsuccess') }}</center>
      </div>
      {{ Session::forget('msgsuccess') }}
    @endif
    @if(Session::get('msgfail'))
      <div class="alert alert-danger fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgfail') }}</center>
      </div>
      {{ Session::forget('msgfail') }}
    @endif

    
    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Edit Account
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
        <div class="form-group @if ($errors->has('account_type')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Account Type</label>
            <div class="col-sm-10">
                {{ Form::text('type', $account->type, array('class' => 'form-control', 'placeholder' => 'Account Type','maxlength'=>'255', 'disabled')) }}
       
                @if ($errors->has('type')) 
                    <p class="help-block">{{ $errors->first('type') }}</p> 
                @endif
            </div>
        </div>
        <br><br>
        <div class="form-group @if ($errors->has('reg_fee')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Registration Fee</label>
            <div class="col-sm-10">
                {{ Form::text('reg_fee', $account->reg_fee, array('class' => 'form-control', 'placeholder' => 'Registration Fee','maxlength'=>'255')) }}
       
                @if ($errors->has('reg_fee')) 
                    <p class="help-block">{{ $errors->first('reg_fee') }}</p> 
                @endif
            </div>
        </div>
        <br><br>
        <div class="form-group @if ($errors->has('ini_dep')) has-error @endif">
            <label class="col-sm-2 col-sm-2 control-label">Initial Deposit</label>
            <div class="col-sm-10">
         
                {{ Form::text('ini_dep', $account->ini_dep, array('class' => 'form-control', 'placeholder' => 'Initial Deposit','maxlength'=>'255')) }}
       
                @if ($errors->has('ini_dep')) 
                    <p class="help-block">{{ $errors->first('ini_dep') }}</p> 
                @endif
            </div>
        </div>
        <br><br>
        <div class="form-group @if ($errors->has('maintaining_bal')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Maintaining Balance</label>
            <div class="col-sm-10">
                {{ Form::text('maintaining_bal', $account->maintaining_bal, array('class' => 'form-control', 'placeholder' => 'Maintaining Balance','maxlength'=>'255')) }}
       
                @if ($errors->has('maintaining_bal')) 
                    <p class="help-block">{{ $errors->first('maintaining_bal') }}</p> 
                @endif
            </div>
        </div>
        <br><br>
        <div class="form-group @if ($errors->has('interest_rate')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Interest Rate</label>
            <div class="col-sm-10">
                {{ Form::text('interest_rate', $account->interest_rate, array('class' => 'form-control', 'placeholder' => 'Interest Rate','maxlength'=>'255')) }}
       
                @if ($errors->has('interest_rate')) 
                    <p class="help-block">{{ $errors->first('interest_rate') }}</p> 
                @endif
            </div>
        </div>
        <br><br>
        <div class="form-group @if ($errors->has('interest_interval_days')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Interest Interval Days</label>
            <div class="col-sm-10">
                {{ Form::number('interest_interval_days', $account->interest_interval_days, array('class' => 'form-control', 'placeholder' => 'Interest Interval Days','maxlength'=>'255')) }}
       
                @if ($errors->has('interest_interval_days')) 
                    <p class="help-block">{{ $errors->first('interest_interval_days') }}</p> 
                @endif
            </div>
        </div>
                 <br><br>  
        <div class="col-lg-12" align="center">
            <input type="hidden" name="id" value="{{$account->id}}">
        {{ Form::submit('Save', ['class' => 'btn btn-success left-sbs sbmt']) }}
        <a href="/admin/accounts" class="btn btn-danger sbmt-b">Cancel</a>
     
        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@stop
