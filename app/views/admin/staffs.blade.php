
@extends('layouts.main')

@section('title')
    Staffs Management
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
                    Staffs Management
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Name</th>
                <th>Position / Branch</th>
                <th>Contact Number</th>
                <th>Email</th>
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

            @foreach($staffs as $staff)


                <tr >
                    <td>{{ $staff->lastname.", ".$staff->firstname." ".$staff->middlename  }}</td>
                  
                    <td>
                        <?php 
                                $position = Position::find($staff->position_id);
                                $branch = Branch::find($staff->branch_id);
                        ?>
                        {{$branch->name}} / {{ $position->title }}</td>
                    <td>{{ $staff->contact_number }}</td>
                    <td>{{ $staff->email }}</td>
                    <td>
                        <a href="/admin/staffs/edit/{{$staff->id}}">
                              <button class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i></button>
                        </a> 
               
                        @if($staff->status==1)
                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="{{ '#deactivate_' . $staff->id }}"  data-toggle="tooltip" data-placement="top"  title="Deactivate Staff">Deactivate</button>
                        @else
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="{{ '#activate_' . $staff->id }}"  data-toggle="tooltip" data-placement="top"  title="Activate Staff">Activate</button>
                        @endif
                    </td>

                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $staffs->links(); }}</center>

    <center><a href="/admin/staffs/add">
                              <button class="btn btn-primary" >Add New Staff</button>
                        </a> </center>
    </div>

   
</div>
</div>
</div>
</div>
</div>
    
  
    </div>







@stop

@section('dialogs')
@foreach($staffs as $staff)
    <?php 
        $modalName = "deactivate";
        $message = "Are you sure you want to deactivate staff {$staff->firstname} {$staff->lastname} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $staff->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Deactivate Staff</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/staffs/deactivate/{{$staff->id}}" class="btn btn-warning" id="confirm">Deactivate </a>
                </div>
            </div>
        </div>
    </div>              

    <?php 
        $modalName = "activate";
        $message = "Are you sure you want to activate staff {$staff->firstname} {$staff->lastname} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $staff->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Activate Staff</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/staffs/activate/{{$staff->id}}" class="btn btn-success" id="confirm">Activate </a>
                </div>
            </div>
        </div>
    </div>              
@endforeach
@stop