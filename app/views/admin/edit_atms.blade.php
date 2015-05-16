
@extends('layouts.main')

@section('title')
    ATM Management
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
                    Edit ATM
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
        <div class="form-group @if ($errors->has('name')) has-error @endif">
          <label class="col-sm-2 col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                {{ Form::text('name', $atm->name, array('class' => 'form-control', 'placeholder' => 'Name','maxlength'=>'255')) }}
       
                @if ($errors->has('name')) 
                    <p class="help-block">{{ $errors->first('name') }}</p> 
                @endif
            </div>
        </div>
        <br><br>

        <div class="form-group @if ($errors->has('address')) has-error @endif">
         <label class="col-sm-2 col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                {{ Form::text('address', $atm->address, array('class' => 'form-control', 'placeholder' => 'Address','maxlength'=>'255')) }}
       
                @if ($errors->has('address')) 
                    <p class="help-block">{{ $errors->first('address') }}</p> 
                @endif
            </div>
        </div>
      <br><br>
       <div class="form-group @if ($errors->has('branch')) has-error @endif">
       <label class="col-sm-2 col-sm-2 control-label">Branch</label>
            <div class="col-sm-10">
               <select name = "branch" class="form-control">
                <?php 
                $branches = Branch::get();
                ?>
                @foreach($branches as $branch)
                <option value="{{$branch->id}}" @if($atm->branch_id==$branch->id) selected @endif>{{$branch->name}}</option>
                @endforeach
                </select>
            @if ($errors->has('branch')) 
                <p class="help-block">{{ $errors->first('branch') }}</p>  
            @endif
        </div>
        </div>
        <br><br>

                   
        <div class="col-lg-12" align="center">
            <input type="hidden" name="id" value="{{$atm->id}}">
        {{ Form::submit('Save', ['class' => 'btn btn-success left-sbs sbmt']) }}
        <a href="/admin/atms" class="btn btn-danger sbmt-b">Cancel</a>
     
        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@stop
