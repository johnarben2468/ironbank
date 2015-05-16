
@extends('layouts.main')

@section('title')
    Positions Management
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
                    Edit Position
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
      <div class="form-group @if ($errors->has('title')) has-error @endif" >
          <label class="col-sm-2 col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                {{ Form::text('title',$position->title, array('class' => 'form-control  ', 'placeholder' => 'Position Title','maxlength'=>'255')) }}
            
       
            @if ($errors->has('title')) 
                <p class="help-block">{{ $errors->first('title') }}</p>  
            @endif
            </div>

        </div>
        <div class="form-group @if ($errors->has('roles')) has-error @endif">
         
              <label class="col-sm-2 col-sm-2 control-label">Roles</label>
        <div class="col-sm-10">
        <div class="checkbox" align="left">
            
            <label>
                <input type="checkbox"  name="roles[]" value="reg"  @if($position->reg==1) checked @endif>
                Registation Processing 
            </label>
            <br>
          
            <label>
                <input type="checkbox"  name="roles[]" value="manage_staff"  @if($position->manage_staff==1) checked @endif>
                Management of Branch Staffs
            </label>
            <br>
            <label>
                <input type="checkbox"  name="roles[]" value="manage_acc_sav"  @if($position->manage_acc_sav==1) checked @endif>
                Management of Savings Account
            </label>
            <br>
            <label>
                <input type="checkbox"  name="roles[]" value="manage_acc_tim"  @if($position->manage_acc_tim==1) checked @endif>
                Management of Time Deposit Accounts
            </label>
            <br>
            <label>
                <input type="checkbox" name="roles[]" value="audit_trail"  @if($position->audit_trail==1) checked @endif>
                Branch Audit Trail
            </label>
            <br>
            <label>
                <input type="checkbox"  name="roles[]" value="transact_deposit"  @if($position->transact_deposit==1) checked @endif>
                Deposit Transaction Processing
            </label>
            <br>
            <label>
                <input type="checkbox"  name="roles[]" value="transact_withdraw"  @if($position->transact_withdraw==1) checked @endif>
                Withdraw Transaction Processing
            </label>
            <br>
            <label>
                <input type="checkbox"  name="roles[]" value="transact_transfer"  @if($position->transact_transfer==1) checked @endif>
                Fund Transfer Transaction Processing
            </label>
            <br>

        </div>
             @if ($errors->has('roles')) 
                    <p class="help-block">{{ $errors->first('roles') }}</p> 
                @endif
            </div>
        </div>
      
                   
        <div class="col-lg-12" align="center">
            <input type="hidden" name="id" value="{{$position->id}}">
        {{ Form::submit('Save', ['class' => 'btn btn-success left-sbs sbmt']) }}
        <a href="/admin/positions" class="btn btn-danger sbmt-b">Cancel</a>
     
        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@stop
