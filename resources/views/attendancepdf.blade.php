<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail</title>
</head>
<body>
    {{ $title }}

   @php
   $row = DB::table('attendances')->where('user_id', $id)->get();
   @endphp

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

        @foreach($row as $rows)
          <tr>
              <td>{{$rows->user_id}}</td>
              <td>{{$rows->check_in}}</td>
              <td>{{$rows->check_out}}</td>
              <td>{{$rows->present}}</td>
            </tr>
        @endforeach
        </tbody>

      </table>


</body>
</html>
