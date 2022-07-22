<!-- Modal -->
<div class="modal fade" id="modalshowsign{{$notirepairs->noti_repair_no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable " role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
                <div class="row" style="text-align:center">
                    <div class="col">
                        <img src="{{$notirepairs->sign}}">
                    </div>
                </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature").val('');
    });
</script>
