
@extends('layouts/main')

@section('title')
My Library
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
            <div class='list-group col-md-12'  >
                <a class='list-group-item active'>User Info</a>
                <a class='list-group-item'><b>Name: </b> {{$user->name}}</a>
                @if(Auth::user()->member_type_id!=0)
                <?php 
                $memtype = MemberType::find($user->member_type_id);
                ?>
                <a class='list-group-item'><b>Membership: </b> {{$memtype->type}} </a>
                <a class='list-group-item'><b>Borrow Limit: </b> {{$memtype->borrow_limit}} references </a>
                @endif
            </div>
        </div>

                        
       <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Borrowed References
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">

    <?php
        $entries = ReferenceEntry::where('holder_id', Auth::user()->id)->get();

    ?>
    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Title</th>
                <th>Code</th>
                <th>Days Remaining</th>
            </tr>
        </thead>
        <tbody>

 
            @foreach($entries as $entry)

                <tr >
                    <?php 
                    $ref = ReferenceInfo::find($entry->reference_info_id);
                    $cat = Category::find($ref->category_id);
                    $created = new Carbon($entry->updated_at);
                    $now = Carbon::now();
                 
                    $difference = $created->diff($now)->days; 

                    ?>
                    <td>{{ $ref->title  }}</td>
                    <td> {{$entry->code}}   </td>
                    <td>
                        {{$cat->borrow_limit-$difference}}

                        @if($cat->borrow_limit<$difference)
                        <font color="red">
                            (Overdue)
                        </font>
                        @endif
                    </td>
                   

                </tr>

            @endforeach
        </tbody>
    </table>


    </div>

   
</div>
</div>
</div>
</div>
</div>
        </div>
   
@stop

@section('footer')

@stop