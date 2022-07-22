<div class="modal fade" id="modalexportexcel" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Export Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                
                <form action="{{URL::to('exportequipment')}}" method="post" class="frmexport">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                    <label><a>Choose Equipment Type : </a></label>
                    <select name="equip_type" class="form-control" required>
                    <option disabled selected value>Choose...</option>
                    @foreach($equip_type as $equip_ties)
                        <option value="{{$equip_ties->equip_type_id}}">{{$equip_ties->equip_type_name}}</option>
                    @endforeach
                    </select>

                    <label><a>Choose Computer Type : </a></label>
                    <select name="com_id" class="form-control" required>
                    <option disabled selected value>Choose...</option>
                    @foreach($com_type as $com_types)
                        <option value="{{$com_types->com_id}}">{{$com_types->com_name}}</option>
                    @endforeach
                    </select>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <Button type="button" class="btn btn-primary export" data-dismiss="modal">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>