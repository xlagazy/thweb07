@extends('ftp.ftp')
@section('nav')
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="/ftp">Get</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/put">Put</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/getandput">Get&Put</a>
        </li>
    </ul>
@endsection
@section('ftpcontents')
    
    <h3>Get Save File</h3>

    @if(session()->get('status') == 1)
        <div class="alert alert-success" role="alert">
            Get save file successfuly.
        </div>
        <script type="text/javascript">
            var file = '{{ Session::get('file');}}';
            window.open("http://thweb07/downloadfile/"+file);
        </script>
        @php 
            session()->forget('status');
            session()->forget('file');
        @endphp
    @elseif(session()->get('status') == 2)
        <div class="alert alert-danger" role="alert">
            File not found, Please try again.
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
    @elseif(session()->get('status') == 4)
        <div class="alert alert-danger" role="alert">
            Not found library, Please try again.
        </div>
        @php 
            session()->forget('status');
        @endphp
    @endif  

    <form action="{{URL::to('getftp')}}" method="post" enctype="multipart/form-data" class="frm needs-validation">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

        <div class="form-group">
            <label>Host</label>
            <select class="form-control" name="host" id="host">
                @if (old('host') == "10.230.1.32")
                    <option value="10.230.1.32" selected>THAI</option>
                @else
                    <option value="10.230.1.32">THAI</option>
                @endif

                @if (old('host') == "10.230.1.70")
                    <option value="10.230.1.70" selected>THAIDEV</option>
                @else
                    <option value="10.230.1.70">THAIDEV</option>
                @endif
            </select>
        </div>
        
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
            <div class="invalid-feedback">Please input data</div>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}" required>
            <div class="invalid-feedback">Please input data</div>
        </div>

        <div class="form-group">
            <label>Library</label>
            <input type="text" class="form-control" id="library" name="library" placeholder="Library" value="{{ old('library') }}" required>
            <div class="invalid-feedback">Please input data</div>
        </div>

        <div class="form-group">
            <label>File name</label>
            <input type="text" class="form-control" id="filename" name="filename" placeholder="File name" value="{{ old('filename') }}" required>
            <div id="feedback-format" class="invalid-feedback">Please input data</div>
        </div>

        <div class="form-group" id="process" style="display:none;">
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary submit">Get Save File</button>

    </form>

    <script>

    $(".frm").on("click",".submit",function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        var filename = document.getElementById('filename');
        var host = document.getElementById('host');
        var filter = /^([a-zA-Z0-9_\.\-])+.savf/;
        var filterupper = /^([a-zA-Z0-9_\.\-])+.SAVF/;

        if(form[0].checkValidity() === false){
            event.preventDefault();
            event.stopPropagation();
        }
        else{

            if (!filter.test(filename.value) && !filterupper.test(filename.value)) {

                filename.classList.add('is-invalid');
                document.getElementById('feedback-format').innerHTML = "Invalid format file name, Ex.(name.savf)";

                return false;

            }
            else{
                Swal.fire({
                    title: 'Get save file!!',
                    text: "Do you want get save file?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Confirm get save file!!',
                            html: "Confirm get save file <strong>\""+filename.value+"\"</strong> from host <strong>"+host.options[host.selectedIndex].text+"</strong>",
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
        }

        form.addClass('was-validated');

    });  

    function checkValidation(check){
        if(check.value != ""){
            check.classList.add("is-valid");
        }else{
            check.classList.add("is-invalid");
        }
    }

    </script> 

@endsection