@extends('layouts.app')

@section('content')

@include('layouts.sidebar')

<div class=" justify-content-right float-right pt-5 pr-5">
    <fieldset class="form-group">
        <select  class="form-control" id="month" name="month" mulitple>
            <option> Select Month </option>
            @foreach($getMonth as $month)
                <option>
                    {!! $month!!}
                </option>
            @endforeach
        </select>                              
    </fieldset>
</div>
<div>{!! $chart->html() !!}</div>



<div class="container" >
    <h3 class="text-center mt-3 mb-5"> Fastech Attendance</h3>

    <a href="{{url ('export/'.$id) }}"><i class="fa fa-download btn btn-md btn-success"></i>Excel</a>
    <a href="{{url('generate-pdf/'.$id)}}"><i class="fa fa-download btn btn-md btn-danger"></i> PDF </a>

<div style="overflow-x:auto; width:100%;">

    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr>

              <th>User ID</th>
            <th>Check-in Time</th>
            <th>Check-out Time</th>
            <th class="th-sm">Present
            </th>

          </tr>
        </thead>

        <tbody>
          
        
@foreach($monthss as $row) 
          <tr>
              <td>{{$row->user_id}}</td>
              <td>{{$row->check_in}}</td>
              <td>{{$row->check_out}}</td>
              <td>{{$row->present}}</td>
            </tr>
        @endforeach

        
        </tbody>

      </table>
      </div>
</div>

{!! Charts::scripts() !!}
{!! $chart->script() !!}

@endsection
