<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Report Request User</title>
    <style>
        .stamp table, td, th {
            border: 1px solid black;
            font-size:10px;
        }

        .stamp table {
            margin-left:720px;
            border-collapse: collapse;
        }

        .stamp th{
            text-align:center;
            width:100px;
        }
        .stamp td{
            height:50px;
        }
    </style>
</head>
<body>
    <div class="float-right">
        IT Control No.
    </div>
    @foreach($data as $request_user)
    <div style="margin-top:2%;">
        <table style="width:100%;padding:0px;border-collapse:collapse;">
            
        </table>
    </div>
    @endforeach

</body>
</html>