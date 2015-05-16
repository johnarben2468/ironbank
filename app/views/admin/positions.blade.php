
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

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Positions Management
                </div>
                <div class="panel-body">
               
                        <div align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Title</th>
             
                
       
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

            @foreach($positions as $position)


                <tr >
                    <td>{{ $position->title }}</td>
                
               
                    <td>
                        <a href="/admin/positions/edit/{{$position->id}}">
                              <button class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i></button>
                        </a> 
               
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="{{ '#view_' . $position->id }}"  data-toggle="tooltip" data-placement="top"  title="View Details">View Details</button>

                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="{{ '#delete_' . $position->id }}"  data-toggle="tooltip" data-placement="top"  title="Delete Position">Delete</button>
                     
                    </td>

                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $positions->links(); }}</center>

   
    </div>

   
</div>

</div>
</div>
</div>

          {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Add Position
                </div>
                <div class="panel-body">
                 
                        <div align="center">
        
      

        <div class="form-group @if ($errors->has('title')) has-error @endif" >
          <label class="col-sm-2 col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                {{ Form::text('title',Session::get('title'), array('class' => 'form-control  ', 'placeholder' => 'Position Title','maxlength'=>'255')) }}
            
       
            @if ($errors->has('title')) 
                <p class="help-block">{{ $errors->first('title') }}</p>  
            @endif
            </div>

        </div>
        <div class="form-group @if ($errors->has('roles')) has-error @endif">
         
              <label class="col-sm-2 col-sm-2 control-label">Roles</label>
        <div class="col-sm-10">
        <div class="checkbox" align="left">
           
            
            <label lass="checkbox-inline">
                <input type="checkbox" name="roles[]" value="reg">
                Registation Processing 
            </label>
            <br>
         
            <label lass="checkbox-inline">
                <input type="checkbox" name="roles[]" value="manage_staff">
                Management of Branch Staffs
            </label >
            <br>
            <label lass="checkbox-inline">
                <input type="checkbox" name="roles[]" value="manage_acc_sav">
                Management of Savings Account
            </label>
            <br>
            <label lass="checkbox-inline">
                <input type="checkbox" name="roles[]" value="manage_acc_tim">
                Management of Time Deposit Accounts
            </label>
            <br>
            <label lass="checkbox-inline">
                <input type="checkbox" name="roles[]" value="audit_trail">
                Branch Audit Trail
            </label>
            <br>
            <label lass="checkbox-inline">
                <input type="checkbox" name="roles[]" value="transact_deposit">
                Deposit Transaction Processing
            </label>
            <br>
            <label lass="checkbox-inline">
                <input type="checkbox" name="roles[]" value="transact_withdraw">
                Withdraw Transaction Processing
            </label>
            <br>
            <label lass="checkbox-inline">
                <input type="checkbox" name="roles[]" value="transact_transfer">
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

@foreach($positions as $position)
    <?php 
        $modalName = "view";
    
    ?>

   
    <div class="modal fade" id="{{ $modalName . '_' . $position->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">{{$position->title}} Details</b>
                </div>
                <div class="modal-body">
                    <font color="black">
                       
                         <label class="col-sm-2 col-sm-2 control-label">Roles</label>
        <div class="col-sm-10">
        <div class="checkbox">
            
            <label>
                <input type="checkbox"  value="reg" disabled @if($position->reg==1) checked @endif>
                Registation Processing 
            </label>
            <br>
            
            <label>
                <input type="checkbox"  value="manage_staff" disabled @if($position->manage_staff==1) checked @endif>
                Management of Branch Staffs
            </label>
            <br>
            <label>
                <input type="checkbox"  value="manage_acc_sav" disabled @if($position->manage_acc_sav==1) checked @endif>
                Management of Savings Account
            </label>
            <br>
            <label>
                <input type="checkbox"  value="manage_acc_tim" disabled @if($position->manage_acc_tim==1) checked @endif>
                Management of Time Deposit Accounts
            </label>
            <br>
            <label>
                <input type="checkbox" value="audit_trail" disabled @if($position->audit_trail==1) checked @endif>
                Branch Audit Trail
            </label>
            <br>
            <label>
                <input type="checkbox"  value="transact_deposit" disabled @if($position->transact_deposit==1) checked @endif>
                Deposit Transaction Processing
            </label>
            <br>
            <label>
                <input type="checkbox"  value="transact_withdraw" disabled @if($position->transact_withdraw==1) checked @endif>
                Withdraw Transaction Processing
            </label>
            <br>
            <label>
                <input type="checkbox"  value="transact_transfer" disabled @if($position->transact_transfer==1) checked @endif>
                Fund Transfer Transaction Processing
            </label>
            <br>

        </div>
    </div>

                    </font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>            


     <?php 
        $modalName = "delete";
        $message = "Are you sure you want to delete position {$position->title}?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $position->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Delete Position</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/positions/delete/{{$position->id}}" class="btn btn-warning" id="confirm">Delete </a>
                </div>
            </div>
        </div>
    </div>              

@endforeach
@stop