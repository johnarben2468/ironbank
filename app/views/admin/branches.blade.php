
@extends('layouts.main')

@section('title')
    Branches Management
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
                    Branches Management
                </div>
                <div class="panel-body">
               
                        <div align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Contact Number</th>
        
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

            @foreach($branches as $branch)


                <tr >
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->address }}</td>
                   <td>{{ $branch->contact_number }}</td>
                   
                  
                    <td>
                        <a href="/admin/branches/edit/{{$branch->id}}">
                              <button class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i></button>
                        </a> 
               
                  
                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="{{ '#delete_' . $branch->id }}"  data-toggle="tooltip" data-placement="top"  title="Delete Branch">Delete</button>
                       
                    </td>

                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $branches->links(); }}</center>

   
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
                    Add Branch
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
        <br>

        <div class="form-group @if ($errors->has('contact_number')) has-error @endif">
          <label class="col-sm-2 col-sm-2 control-label">Contact Number</label>
            <div class="col-sm-10">
                {{ Form::text('contact_number',Session::get('contact_number'), array('class' => 'form-control  ', 'placeholder' => 'Contact Number','maxlength'=>'255')) }}
       
            @if ($errors->has('contact_number')) 
                <p class="help-block">{{ $errors->first('contact_number') }}</p>  
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

@foreach($branches as $branch)
    <?php 
        $modalName = "delete";
        $message = "Are you sure you want to delete branch {$branch->name} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $branch->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Delete Branch</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/branches/delete/{{$branch->id}}" class="btn btn-warning" id="confirm">Delete</a>
                </div>
            </div>
        </div>
    </div>              

        
@endforeach
@stop