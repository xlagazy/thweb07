<label><b>Borrow</b></label>
<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="table-responsive">
        <table class="table table-sm" style="font-size:0.8em">
            <thead>
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
            </thead>
            <tbody id="myTable">

            @foreach($borrow as $key => $borrows)
                <tr>
                    <td style="text-align:center;">{{$borrow->firstItem() + $key}}</td>
                    <td>{{$borrows->equipment_no}}</td>
                    <td>{{$borrows->equipment_name}}</td>
                    <td>{{$borrows->com_name}}</td>
                    <td>{{$borrows->user_borrow}}</td>
                    <td>{{$borrows->sect_name}}</td>
                    <td>{{date("d-M-Y", strtotime($borrows->start_date))}}</td>
                    <td>{{date("d-M-Y", strtotime($borrows->end_date))}}</td>
                    <td>{{$borrows->name}}</td>
                    <td style="color:white;">
                        @if($borrows->borrow_status == 1)
                            <p style="background-color:green; text-align:center;"><b>{{$borrows->borrow_status_name}}</b></p>
                        @else
                            <p style="background-color:red; text-align:center;"><b>{{$borrows->borrow_status_name}}</b></p>
                        @endif
                    </td>
                </tr>

            @endforeach
            </tbody>
            <a href="/listborrow" class="float-right">เพิ่มเติม>></a>
        </table>
    </div>
</div>