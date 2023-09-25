<!-- Modal Detail -->
<div class="modal fade text-left" id="receiverequest{{$data->no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">Assign request user</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
            <form action="/listrequestuser/it/assign" method="post" enctype="multipart/form-data" class="frm">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <input type = "hidden" name = "no" id = "no" value="{{$data->no}}">

                <div class="form-group row">
                    <div class="col">
                        <b>Assign work to </b>
                        <select name="charge" class="form-control statusrequest" required>
                            <option selected value>Choose...</option>
                            @foreach($member as $members)
                                <option value="{{$members->user_id}}">{{$members->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>
                </div>

                <div id="hidden_button" class="text-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="button" name="btn2" class="btn btn-success assignrequestuser">Assign</button>
                </div>
            </form>

            <script type="text/javascript" src="{{asset('scripts/receiverequestuser.js')}}"></script>

        </div>
    </div>
</div>