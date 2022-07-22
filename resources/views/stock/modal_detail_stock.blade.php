@php
    $borrow = DB::select('select eq.equipment_no, eq.equipment_name, ct.com_name, br.user_borrow, se.sect_name, br.start_date, br.end_date, mb.name,
                          br.borrow_status, bs.borrow_status_name from borrow br
                          inner join stock st
                          on br.stock_no = st.stock_no
                          inner join equipment eq
                          on eq.equipment_no = st.equipment_no
                          inner join member mb
                          on br.charge = mb.user_id
                          inner join com_type ct
                          on eq.com_id = ct.com_id
                          inner join section se
                          on br.sect_id = se.sect_id
                          inner join borrow_status bs
                          on br.borrow_status = bs.borrow_status_no
                          where br.stock_no = ? 
                          order by br.borrow_no desc', [$stocks->stock_no] );
@endphp
<!-- Modal detail -->
<div class="modal fade" id="dtmodal{{$stocks->stock_no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">Stock : {{$stocks->equipment_no}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
            <div class="row">
                <div class="col">
                    <label><b>Equipment name</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$stocks->equipment_name}}</p>
                </div>

                <div class="col">
                    <label><b>Computer Type</b></label>
                    <hr style="padding:0;margin:0;">
                    <p>{{$stocks->com_name}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label><b>status</b></label>
                    <hr style="padding:0;margin:0;">
                    @if($stocks->stock_status == 1)
                        <p>{{$stocks->stock_status_name}}</p>
                    @else
                        <p>{{$stocks->stock_status_name}}</p>
                    @endif
                </div>

                <div class="col">
                </div>
            </div>
            <div>
                <table style="color:000;">
                    <tr>
                        <th scope="col" style="text-align:center;">No</th>
                        <th scope="col">Equipment Number</th>
                        <th scope="col">Equipment Name</th>
                        <th scope="col">Computer Type</th>
                        <th scope="col">User Borrow</th>
                        <th scope="col">Section</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Charge</th>
                        <th scope="col" style="text-align:center;">Status</th>
                    </tr>
                    @php 
                        $no = 1;
                    @endphp
                    @foreach($borrow as $key => $borrows)
                        <tr>
                            <td style="text-align:center;">{{$no}}</td>
                            <td>{{$borrows->equipment_no}}</td>
                            <td>{{$borrows->equipment_name}}</td>
                            <td>{{$borrows->com_name}}</td>
                            <td>{{$borrows->user_borrow}}</td>
                            <td>{{$borrows->sect_name}}</td>
                            <td>{{date("d-M-Y", strtotime($borrows->start_date))}}</td>
                            <td>{{date("d-M-Y", strtotime($borrows->end_date))}}</td>
                            <td>{{$borrows->name}}</td>
                            <td style="color:#fff;">
                                @if($borrows->borrow_status == 1)
                                    <p style="background-color:green; text-align:center;"><b>{{$borrows->borrow_status_name}}</b></p>
                                @else
                                    <p style="background-color:red; text-align:center;"><b>{{$borrows->borrow_status_name}}</b></p>
                                @endif
                            </td>
                        </tr>
                        @php 
                            $no++;
                        @endphp
                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>