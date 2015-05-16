
@extends('layouts.main')

@section('title')
    Withdraw Transaction
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
                    Withdraw Transaction
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" >
        
        <div class="form-group @if ($errors->has('from_account_code')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">From Account Code</label>
            <div class="col-sm-10">
                {{ Form::text('from_account_code', Session::get('from_account_code'), array('class' => 'form-control', 'placeholder' => 'From Account Code','maxlength'=>'255')) }}
       
                @if ($errors->has('from_account_code')) 
                    <p class="help-block">{{ $errors->first('from_account_code') }}</p> 
                @endif
            </div>
        </div>
       <br><br><br>

       <div class="form-group @if ($errors->has('to_account_code')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">To Account Code</label>
            <div class="col-sm-10">
                {{ Form::text('to_account_code', Session::get('to_account_code'), array('class' => 'form-control', 'placeholder' => 'To Account Code','maxlength'=>'255')) }}
       
                @if ($errors->has('to_account_code')) 
                    <p class="help-block">{{ $errors->first('to_account_code') }}</p> 
                @endif
            </div>
        </div>
       <br><br><br>

       <div class="form-group @if ($errors->has('amount')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Amount</label>
            <div class="col-sm-10">
                {{ Form::text('amount', Session::get('amount'), array('class' => 'form-control', 'placeholder' => 'Amount','maxlength'=>'255')) }}
       
                @if ($errors->has('amount')) 
                    <p class="help-block">{{ $errors->first('amount') }}</p> 
                @endif
            </div>
        </div>
       <br><br>
       
        <div class="col-lg-12" align="center">
    
        {{ Form::submit('Transfer', ['class' => 'btn btn-success left-sbs sbmt']) }}
        <a href="/" class="btn btn-danger sbmt-b">Cancel</a>
     
        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@stop
