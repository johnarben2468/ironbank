
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
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    ATM Management
                </div>
                <div class="panel-body">
               
                        <div align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Access Key</th>
                <th>Status</th>
                <th>Balance</th>
       
                <th>Action </th>

            </tr>
        </thead>
        <tbody>

     @if(Session::get('noresults'))
    <tr>
        <td colspan='6'>
        <center>{{ Session::get('noresults') }}</center>
        </td>
    </tr>
      {{ Session::forget('noresults') }}
    @endif

            @foreach($atms as $atm)


                <tr >
                    <td>{{ $atm->name }}</td>
                    <td>{{ $atm->address }}</td>
                    <td>{{ $atm->access_key }}</td>
                    <td>{{ $atm->status }}</td>
                    <td>{{ $atm->balance }}</td>
               
                    <td>
                        <a href="/admin/atms/edit/{{$atm->id}}">
                              <button class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i></button>
                        </a> 
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="{{ '#cash_' . $atm->id }}"  data-toggle="tooltip" data-placement="top"  title="Cash Supply">View Supply</button>
                        @if($atm->status==1)
                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="{{ '#deactivate_' . $atm->id }}"  data-toggle="tooltip" data-placement="top"  title="Deactivate ATM">Deactivate</button>
                        @else
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="{{ '#activate_' . $atm->id }}"  data-toggle="tooltip" data-placement="top"  title="Activate ATM">Activate</button>
                        @endif
                    </td>

                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $atms->links(); }}</center>

   
    </div>

   
</div>

</div>
</div>
</div>

  
    </div>
<div class="row">
          {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Add ATM
                </div>
                <div class="panel-body">
                 
                        <div align="center">
        
      

        <div class="form-group @if ($errors->has('name')) has-error @endif">
          <label class="col-sm-2 col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                {{ Form::text('name',Session::get('name'), array('class' => 'form-control  ', 'placeholder' => 'Name','maxlength'=>'255')) }}
       
            @if ($errors->has('name')) 
                <p class="help-block">{{ $errors->first('name') }}</p>  
            @endif
            </div>
        </div>
        <br><br>
        <div class="form-group @if ($errors->has('address')) has-error @endif">
          <label class="col-sm-2 col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                {{ Form::text('address',Session::get('address'), array('class' => 'form-control  ', 'placeholder' => 'Address','maxlength'=>'255')) }}
       
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
                <option value="{{$branch->id}}" @if(Session::get('branch_id')==$branch->id) selected @endif>{{$branch->name}}</option>
                @endforeach
                </select>
            @if ($errors->has('branch')) 
                <p class="help-block">{{ $errors->first('branch') }}</p>  
            @endif
        </div>
        </div>
        <br><br>



        <div class="col-lg-12" align="center">
            <input type="submit" class="btn btn-success left-sbs sbmt" value="Add">
      
     
        </div>
        {{ Form::close(); }}
   
                        </div>
                   
                </div>
            </div>
        </div>
</div>
@stop

@section('dialogs')

@foreach($atms as $atm)
    <?php 
        $modalName = "deactivate";
        $message = "Are you sure you want to deactivate atm {$atm->name} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $atm->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Deactivate ATM</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/atms/deactivate/{{$atm->id}}" class="btn btn-warning" id="confirm">Deactivate </a>
                </div>
            </div>
        </div>
    </div>              

    <?php 
        $modalName = "activate";
        $message = "Are you sure you want to activate atm {$atm->name} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $atm->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Activate ATM</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/atms/activate/{{$atm->id}}" class="btn btn-success" id="confirm">Activate </a>
                </div>
            </div>
        </div>
    </div>           
     <?php 
        $modalName = "cash";

    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $atm->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Cash Supply</b>
                </div>
                <div class="modal-body">
                    <p color="black">
                        <div class="row">
                        <div class="col-lg-6"><b>ATM</b></div>
                        <div class="col-lg-6"><b>{{$atm->name}} </b></div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-lg-6"><label>One Thousand Pesos</label></div>
                        <div class="col-lg-6">{{$atm->deno_onethousandpeso}} x</div>
                        </div>
                        <div class="row">
                        <div class="col-lg-6"><label>Five Hundred Pesos</label></div>
                        <div class="col-lg-6">{{$atm->deno_fivehundredpeso}} x</div>
                        </div>
                        <div class="row">
                        <div class="col-lg-6"><label>Two Hundred Pesos</label></div>
                        <div class="col-lg-6">{{$atm->deno_twohundredpeso}} x</div>
                        </div>
                        <div class="row">
                        <div class="col-lg-6"><label>One Hundred Pesos</label></div>
                        <div class="col-lg-6">{{$atm->deno_onehundredpeso}} x</div>
                        </div>
                        <div class="row">
                        <div class="col-lg-6"><label>Fifty Pesos</label></div>
                        <div class="col-lg-6">{{$atm->deno_fiftypeso}} x</div>
                        </div>
                        <div class="row">
                        <div class="col-lg-6"><label>Twenty Pesos</label></div>
                        <div class="col-lg-6">{{$atm->deno_twentypeso}} x</div>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                   
                </div>
            </div>
        </div>
    </div>            
@endforeach
@stop