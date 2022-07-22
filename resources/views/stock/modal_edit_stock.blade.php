<!-- Modal edit -->
<div class="modal fade" id="edtmodal{{$stocks->stock_no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">แก้ไข Stock</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
            <form action="{{URL::to('editstock')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation">   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <input type = "hidden" name = "stock_no" value = "{{$stocks->stock_no}}" >

                <div class="row">
                    <div class="col">
                        <label><b>Equipment Number</b></label>
                        <input type="text" class="form-control" name="equiptype_no" placeholder="Equipment number" value="{{$stocks->equipment_no}}" disabled>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Equipment Name</b></label>
                        <input type="text" class="form-control" name="equiptype_name" placeholder="Equipment number" value="{{$stocks->equipment_name}}" disabled>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><a>Choose Computer Type : </a></label>
                        <select name="stock_status" class="form-control" required>
                            <option disabled selected value>Choose...</option>
                            @foreach($stock_status as $stock_statused)
                                @if($stocks->stock_status == $stock_statused->stock_status_no)
                                    <option value="{{$stock_statused->stock_status_no}}" selected>{{$stock_statused->stock_status_name}}</option>
                                @else
                                    <option value="{{$stock_statused->stock_status_no}}" >{{$stock_statused->stock_status_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" name="btn" class="btn btn-success edt">บันทึก</button>
                </div>

                <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>

            </form>
        </div>
    </div>
</div>