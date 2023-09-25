<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <table class="table table-striped" style="width:80%;margin:auto;">
        <tr>
            <th>No</th>
            <th>Employee Number</th>
            <th>Name</th>
            <th>Assign Date</th>
        </tr>
        @foreach($data->MSEC01P_MSEC01P_R as $key => $query)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$query->CDUSRS}}</td>
                <td>{{$query->NMUSRS}}</td>
                @php 
                  $count = strlen($query->D8ASGN);
                  if($count == 7){
                    $query->D8ASGN = "0".$query->D8ASGN;
                  }

                  $date = substr($query->D8ASGN,0, 2)."-".substr($query->D8ASGN,2, 2)."-".substr($query->D8ASGN,4, 4);

                @endphp 
                <td>
                  @if($query->D8ASGN == 0)
                    -  
                  @else
                    {{date('d-M-Y', strtotime($date))}}
                  @endif
                </td>
            </tr>
        @endforeach
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>