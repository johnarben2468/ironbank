
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
                    Edit Transaction
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
        <div class="form-group @if ($errors->has('type')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Transaction Type</label>
            <div class="col-sm-10">
                {{ Form::text('type', $transaction->type, array('class' => 'form-control', 'placeholder' => 'Transaction Type','maxlength'=>'255', 'disabled')) }}
       
                @if ($errors->has('type')) 
                    <p class="help-block">{{ $errors->first('type') }}</p> 
                @endif
            </div>
        </div>
        <br><br>
     
       
        <div class="form-group @if ($errors->has('fee')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Fee</label>
            <div class="col-sm-10">
                {{ Form::text('fee', $transaction->fee, array('class' => 'form-control', 'placeholder' => 'Registration Fee','maxlength'=>'255')) }}
       
                @if ($errors->has('fee')) 
                    <p class="help-block">{{ $errors->first('fee') }}</p> 
                @endif
        </div>
       </div>
       <br>
       <br>
                   
        <div class="col-lg-12" align="center">
            <input type="hidden" name="id" value="{{$transaction->id}}">
        {{ Form::submit('Save', ['class' => 'btn btn-success left-sbs sbmt']) }}
        <a href="/admin/transactions" class="btn btn-danger sbmt-b">Cancel</a>
     
        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@stop
