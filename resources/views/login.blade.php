<?php 
  function get_browser_name($user_agent){
      $t = strtolower($user_agent);
      $t = " " . $t;
      if (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) {
        header( "location: /errorie" );
        exit(0);
      }
  }
  get_browser_name($_SERVER['HTTP_USER_AGENT']);

  if($_SERVER["HTTP_REFERER"] != ""){
    session()->put('pageref', $_SERVER["HTTP_REFERER"]);
  }
?>
<html>
<head>
    <!-- <meta charset="UTF-8">-->
    <title>login</title>

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="/styles.css">
    <link type="text/css" rel="stylesheet" href="/stylesipad.css">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">
    
    <!-- Scripts -->
    <script src="/scripts/jquery-3.5.1.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/sweetalert2/dist/sweetalert2.min.js"></script>

</head>
<body style="background-color:rgb(0, 173, 241);">

  <div class="shadow p-3 mb-5 bg-white rounded" style="width:25%; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">

    <form action="/loginuser" method="post" style="text-align:center;">

        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

        <div class="form-group" style="margin:10px;">
          <label for="exampleInputEmail1">เข้าสู่ระบบ</label>
        </div>

        <!-- alert message wrong username or password -->

        @if(session()->has('alert'))
          <div class="alert alert-danger" role="alert">
            {{session()->get('alert')}}
          </div>
        @endif

        <div class="form-group" style="margin:20px;">
          <input type="text" class="form-control" name="employees_id" placeholder="Employee ID" style="height:50px; text-align:center; background-color:#EEEEEE;" autofocus required>
        </div>
        <div class="form-group" style="margin:20px;">
          <input type="password" class="form-control" name="password" placeholder="Password" style="height:50px; text-align:center; background-color:#EEEEEE;" required>
        </div>

        <button type="submit" class="btn btn-primary" style="padding: 10px 20px 10px 20px;">Login</button>

    </form>

  </div>
  
</body>
</html>