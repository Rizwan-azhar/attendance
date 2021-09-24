@extends('layouts.app')

@section('content')

@include('layouts.sidebar')

<style>
    .custum-table th{
        min-width:200px !important;
    }
</style>

<h3 class="text-center pl-5 pt-5 pr-5 mt-3 mb-5"> Employee's Progress</h3>
<div class="container " style='overflow-x:auto;'>
<table id="dtBasicExample" class="custum-table table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
@php
    $user = DB::table('users')->where('is_admin', '!=' , 1)->where('is_admin', '!=' , 2)->get();
@endphp
<thead>
    <tr>
        <th>Today's Date</th>        
        <th>Name</th>
        <th>Progress</th>
        <th>Action</th>

                   
                
                </tr>
            </thead>
            <tbody>
                
               
            @foreach($user as $users)
                <tr> 
            <td>
           {{Carbon\Carbon::now()->parse()->format('Y-m-d');}}         
                </td>
            
                    
                <td>   
                    {{$users->name}}
                </td>
              

                <td>
                <form  method="post" action="/progress" enctype='multipart/form-data' >
               <input type="hidden" name="user_id" value="{{$users->id}}">

                <input type="hidden" name="_token" value={{csrf_token()}}>
                <input style="width:20%" type="text" name="progress">/10 
                    <button type="submit" value="Update" class=" btn btn-sm btn-success">Post</button>
                </form>
                </td>
                <td>
                <a href="{{'/view-progress/'.$users->id}}"><button class="btn btn-warning">View Progress</button></a>
                </td>
            </tr>
            @endforeach
</table>
</div>
@endsection