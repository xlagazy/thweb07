@extends('ftp.ftp')
@section('nav')
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="/ftp">Get</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="/put">Put</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/getandput">Get&Put</a>
        </li>
    </ul>
@endsection
@section('ftpcontents')

    <h3>Put Save File</h3>

    @if(session()->get('status') == 1)
        <div class="alert alert-success" role="alert">
            Put save file successfuly.
        </div>

        @php 
            session()->forget('status');
        @endphp
    @elseif(session()->get('status') == 2)
        <div class="alert alert-danger" role="alert">
            Not found library, Please try again.
        </div>
        @php 
            session()->forget('status');
        @endphp
    @elseif(session()->get('status') == 3)
        <div class="alert alert-danger" role="alert">
            Invalid username or password, Please try again.
        </div>
        @php 
            session()->forget('status');
        @endphp
    @endif

    <form action="{{URL::to('putftp')}}" method="post" enctype="multipart/form-data" class="frmput needs-validation">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

        <div class="form-group">
            <label>Host</label>
            <select class="form-control" name="puthost" id="puthost">
                @if (old('puthost') == "10.230.1.32")
                    <option value="10.230.1.32" selected>THAI</option>
                @else
                    <option value="10.230.1.32">THAI</option>
                @endif

                @if (old('puthost') == "10.230.1.70")
                    <option value="10.230.1.70" selected>THAIDEV</option>
                @else
                    <option value="10.230.1.70">THAIDEV</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="putusername" name="putusername" placeholder="Username" value="{{ old('putusername') }}" required>
            <div class="invalid-feedback">Please input data</div>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="putpassword" name="putpassword" placeholder="Password" value="{{ old('putpassword') }}" required>
            <div class="invalid-feedback">Please input data</div>
        </div>

        <div class="form-group">
            <label>Library</label>
            <input type="text" class="form-control" id="putlibrary" name="putlibrary" placeholder="Library" value="{{ old('putlibrary') }}" required>
            <div class="invalid-feedback">Please input data</div>
        </div>
        
        <div class="form-group">
            <label>File name</label>
            <input type="file" class="form-control" id="putfilename" name="putfilename" accept=".savf" value="{{ old('putfilename') }}" required>
            <div id="feedback-format" class="invalid-feedback">Please choose data</div>
        </div>

        <div class="form-group" id="process" style="display:none;">
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-danger putsubmit">Put Save File</button>

    </form>

    <script>

    $(".frmput").on("click",".putsubmit",function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        var filename = document.getElementById('putfilename');
        var host = document.getElementById('puthost');

        if(form[0].checkValidity() === false){
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            Swal.fire({
                title: 'Put save file!!',
                text: "Do you want put save file ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Confirm put save file!!',
                        html: "Confirm put save file <strong>\""+filename.value+"\"</strong> to host <strong>"+host.options[host.selectedIndex].text+"</strong>",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#00C851',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        }

        form.addClass('was-validated');

    });  

    </script>

@endsection
