@extends('layouts.app')

@section('content')

@include('layouts.sidebar')

<h2 class="text-center pt-5">Edit Salary</h2>
<div class="container pt-5">
<form id="btn-submit" method="post" action="/edit_salary" enctype='multipart/form-data'>
    <input class="form-check-input" type="hidden" name="id" value="{{$sal->id}}">

        <div class="form-group">
            <label for="exampleInputEmail1">Salary</label>
            <input  type="number" class="form-control addName {{ $errors->has('image') ? 'is-invalid' : '' }}"  name="salary"  aria-describedby="emailHelp"  value="{{$sal->salary}}">
        </div>
        

        <div class="modal-footer">
            <input type="submit" name="action_button"  class="btn btn-primary btn-block" value="Update" />
            
            <span
                className="close cursor-pointer"
                data-dismiss="modal"
                aria-label="Close"
                id="myModalClose">
            </span>
        
            <input type="hidden" name="_token" value={{csrf_token()}}>

        </div>


    </form>


</div>
@endsection