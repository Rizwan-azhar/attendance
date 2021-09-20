
@extends('layouts.app')


@section('content')
<div class="pt-5 container">
<h2 class="pb-5 text-center float-center"> Manual Attendance</h2>

<table id="dtBasicExample" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
        <thead>
          <tr>
              <th>User ID</th>
            <th class="th-sm">Name
            </th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
         
          <tr>
              <td>{{$user->id}}</td>
               <td>{{$user->name}}</td>
               <td>
               <a href="{{'mark-attendance/'.$user->id}}"><button class="btn btn-success">Present</button></a>
               <a href=""><button class="btn btn-success">Absent</button></a>                                            
               </td>

          </tr>
          @endforeach
        </tbody>

      </table>


      </div>

      
      @endsection