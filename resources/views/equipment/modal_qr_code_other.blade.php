<div class="modal fade" id="qrcodeother{{$equipments->ot_equipment_no}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 6cm;">
        <div class="modal-content">

            <div class="modal-body">
            <div class="border border-dark" style="width:2.3cm;margin:auto;padding:5px;">
                <div class="row" style="writing-mode:vertical-rl;">
                    <div class="col-auto">
                        {{ QrCode::size(70)->generate($equipments->ot_equipment_no) }}
                    </div>
                    <div class="col" style="margin-top:10px;margin-right:10px;font-size:18px;">
                        <b>{{substr($equipments->ot_equipment_no,0,-8)}}</b><br>
                        <b>{{substr($equipments->ot_equipment_no,-7)}}</b>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>