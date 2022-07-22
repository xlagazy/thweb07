<!DOCTYPE html>
<html>
<head>
    <title>IT Sect</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="/styles.css">
    <link type="text/css" rel="stylesheet" href="/stylesipad.css">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/bootstrap-select/dist/css/bootstrap-select.css">
    
    <!-- Scripts -->
    <script src="/scripts/jquery-3.5.1.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/bootstrap-select/dist/js/bootstrap-select.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
</head>
<body>
<div class="container">
  <h2>Transfer save file data AS400</h2>
  <br>
  
  @yield('nav')

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="container tab-pane active border border-4" style="color:#000;background-color:#fff;padding:0 2% 2% 2%;"><br>
        @yield('ftpcontents')
    </div>
  </div>
</body>
</html>