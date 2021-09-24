@extends('layouts.app')

@section('content')

@include('layouts.sidebar')

<h2 class=" pt-5 text-center"> Employees Progress </h2>

<div class=" pt-5 px-5 container">
<table id="dtBasicExample" class="  table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
            <thead>
                <tr>
                
                
                    <th class="th-sm">Dates
                    </th>
                    <th class="th-sm">Progress
                    </th>
                   
                </tr>
            </thead>
            <tbody>

            @foreach($pro as $row)
             
                <tr>
                    <td class="align-middle"> {{$row->check_in}} </td>
                    <td class="align-middle">{{$row->progress}} /10 </td>
                   
                </tr>
@endforeach
            </tbody>

        </table>
        </div>
@endsection