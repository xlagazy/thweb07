<!-- Modal Detail -->
<div class="modal fade text-left" id="requestadmindt{{$data->no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">Request admin detail (#{{$data->track}})</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
            <table style="width: 100%;">
                <tr>
                    <td width="25%"><b>Subject : </b></td>
                    <td>
                        {{$data->subject}}
                    </td>
                </tr>
                <tr>
                    <td><b>Section : </b></td>
                    <td>
                        {{$data->sect_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Need date : </b>
                    </td>
                    <td>
                        {{date('d-M-Y', strtotime($data->need_date))}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Related to Other section : </b>
                    </td>
                    <td>
                        @php
                            $relate_sect = json_decode($data->relate_sect);
                            $relate_sect_approve = json_decode($data->relate_sect_approve);
                            if(isset($relate_sect)){
                                $count = count($relate_sect);
                            }
                            else{
                                $count = 0;
                            }

                            if($count == 0){
                                echo "None";
                            }
                            else{
                                for($i=0;$i<$count;$i++){
                                    echo $i+1;
                                    echo '. ';
                                    echo App\Http\Controllers\Controller::getSection($relate_sect[$i]);
                                    echo '<br>';
                                }
                            }
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Reason or Problem : </b>
                    </td>
                    <td>
                        {{$data->reason}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Reference Document no. : </b>
                    </td>
                    <td>
                        {{$data->reference}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Detail : </b>
                    </td>
                    <td>
                        {{$data->detail}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Attach file : </b>
                    </td>
                    <td>
                        @if(empty($data->attach_file))
                            -
                        @else
                            @php 
                                $arrAttachfile = json_decode($data->attach_file);
                                $countAttachfile = count($arrAttachfile);
                            @endphp
                            @if(isset($arrAttachfile))
                                @for($i=0;$i<$countAttachfile;$i++)
                                    <a href="/file/request_admin/attach_file/{{$arrAttachfile[$i]}}" target="_blank">Attach File {{$i+1}}</a><br>
                                @endfor
                            @endif 
                        @endif
                    </td>
                </tr>
            </table>
        </div>
       
    </div>
</div>