<div class="modal fade" id="qrcode{{$equipments->equipment_no}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 6cm;">
        <div class="modal-content">

            <div class="modal-body">
            <div class="border border-dark" style="width:2.3cm;margin:auto;padding:5px;">
                <div class="row" style="writing-mode:vertical-rl;">
                    <div class="col-auto">
                        {{ QrCode::size(70)->generate($equipments->equipment_no) }}
                    </div>
                    <div class="col" style="margin-top:10px;font-size:11px;">
                        <b>{{$equipments->equipment_no}}
                        <br>Section : {{$equipments->sect_name}}
                        <br>Start Date: <br>{{date("d-M-Y", strtotime($equipments->setup_date))}}</b>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>