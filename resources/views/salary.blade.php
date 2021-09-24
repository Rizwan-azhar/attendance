@extends('layouts.app')

@section('content')

@include('layouts.sidebar')

<h2 class=" pt-5 text-center"> Employees Salary </h2>


<div class=" pt-5 px-5 container">
<table id="dtBasicExample" class="  table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
            <thead>
                <tr>
                
                
                    <th class="th-sm">Name
                    </th>
                    <th class="th-sm">Salary
                    </th>
                    <th class="th-sm">Action
                    </th>
                   
                </tr>
            </thead>
            <tbody>

            @foreach($salary as $row)
             
                <tr>
                    <td class="align-middle"> {{$row->name}} </td>
                    <td class="align-middle">{{$row->salary}} </td>
                    <td>
                    <a href="{{'update_salary/'.$row->id}}"><button class="btn btn-warning">Edit</button></a>
                    </td>
                   
                </tr>
@endforeach
            </tbody>

        </table>
        </div>




       

@endsection