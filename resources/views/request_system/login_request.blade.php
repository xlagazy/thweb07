<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="color:#000;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">เข้าสู่ระบบ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <form action="/loginrequest" method="post" style="text-align:center;">

                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                <!-- alert message wrong username or password -->

                @if(session()->has('alert'))
                  <script>
                  $('#loginbtn').click();
                  </script>
                  <div class="alert alert-danger" role="alert">
                    {{session()->get('alert')}}
                  </div>
                @endif

                <div class="form-group" style="margin:20px;">
                  <input type="text" class="form-control" name="username" placeholder="Username" style="height:50px; text-align:center; background-color:#EEEEEE;" autofocus required>
                </div>
                <div class="form-group" style="margin:20px;">
                  <input type="password" class="form-control" name="password" placeholder="Password" style="height:50px; text-align:center; background-color:#EEEEEE;" required>
                </div>

                <button type="submit" class="btn btn-primary" style="padding: 10px 20px 10px 20px;">Login</button>

            </form>
        </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>