<!-- Modal -->
<div class="modal fade" id="track" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">ติดตามสถานะแจ้งซ่อม</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="/tracknotifyrepair" method="get" class="frmcheck">
                <table style="margin:auto;">
                    <tr>
                        <td style="width:90%;">
                            <input type="text" name="track" class="form-control" id="tracking" maxlength="8" placeholder="กรอกหมายเลข Track" required>
                            <div id="feedback" class="invalid-feedback">กรุณากรอกข้อมูล</div>
                        </td>
                        <td style="width:20%;">
                            <button type="button" class="btn btn-primary track" data-dismiss="modal">Track</button>
                        </td>
                    </tr>
                </table>
                <p id="invalid-data" style="color:red;"></p>
            </form> 
        </div>
    </div>
  </div>
</div>
