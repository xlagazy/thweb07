<!-- Modal detail -->
<div class="modal fade" id="dtmodal{{$borrows->borrow_no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">Borrow : {{$borrows->equipment_no}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
            <div class="row">
                <div class="col">
                    <label><b>Equipment name</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$borrows->equipment_name}}</p>
                </div>

                <div class="col">
                    <label><b>Computer Type</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$borrows->com_name}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>Status</b></label>
                    <hr style="padding:0;margin:0;">
                    @if($borrows->borrow_status == 1)
                        <p><b>{{$borrows->borrow_status_name}}</b></p>
                    @else
                        <p><b>{{$borrows->borrow_status_name}}</b></p>
                    @endif
                </div>

                <div class="col">
                    <label><b>User Borrow</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$borrows->user_borrow}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>Section</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$borrows->sect_name}}</p>
                </div>

                <div class="col">
                    <label><b>Start Date</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$borrows->start_date}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>End Date</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$borrows->end_date}}</p>
                </div>

                <div class="col">
                    <label><b>Charge</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$borrows->name}}</p>
                </div>
            </div>

            <div class="row" style="text-align:center;">
                <div class="col">
                    <label><b>Signature</b></label>
                    <hr style="padding:0;margin:0;">
                    @if(!empty($borrows->signature))
                    <img src="{{$borrows->signature}}">
                    @endif
                </div>
            </div>  
        </div>
    </div>
</div>