<!-- Modal Detail -->
<div class="modal fade text-left" id="requestuserdt{{$data->no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header" style="color:#000;">
            <h5 class="modal-title" id="exampleModalLongTitle">Request user detail (#{{$data->track}})</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color:#000;">
            <table style="width: 100%;">
                <tr>
                    <td><b>Subject : </b></td>
                    <td>
                        @if($data->subject == 0)
                            Add
                        @elseif($data->subject == 1)
                            Delete
                        @elseif($data->subject == 2)
                            Change
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><b>User Access : </b></td>
                    <td>
                        @if($data->email_ad == 1)
                            <i class="fa fa-check-square-o" aria-hidden="true"></i> Email and AD user <br>
                        @else
                            <i class="fa fa-square-o" aria-hidden="true"></i> Email and AD user <br>
                        @endif
                        @if($data->as400_user == 1)
                            <i class="fa fa-check-square-o" aria-hidden="true"></i> AS400 User <br>
                        @else
                            <i class="fa fa-square-o" aria-hidden="true"></i> AS400 User <br>
                        @endif
                        @if($data->email_only == 1)
                            <i class="fa fa-check-square-o" aria-hidden="true"></i> Email Only <br>
                        @else
                            <i class="fa fa-square-o" aria-hidden="true"></i> Email Only <br>
                        @endif
                        @if($data->ad_only == 1)
                            <i class="fa fa-check-square-o" aria-hidden="true"></i> AD User Only <br>
                        @else
                            <i class="fa fa-square-o" aria-hidden="true"></i> AD User Only <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Effective date : </b>
                    </td>
                    <td>
                        {{date('d-M-Y', strtotime($data->effective_date))}}
                    </td>
                </tr>

                <!-- User Detail -->
                <tr>
                    <td><b>User Detail</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        Employee Number
                    </td>
                    <td>
                        {{$data->employee_no}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Name / Surname :
                    </td>
                    <td>
                        {{$data->fullname}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Position :
                    </td>
                    <td>
                        {{$data->position}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Section :
                    </td>
                    <td>
                        {{$data->sect_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Remark :
                    </td>
                    <td>
                        {{$data->remark}}
                    </td>
                </tr>

                @if($data->subject == 0)
                    @if($data->email_ad == 1 || $data->ad_only == 1)
                        <!-- Permission AD -->
                        <tr>
                            <td><b>Permission AD</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                Permission : 
                            </td>
                            <td>
                                @if($data->wireless == 1)
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i> Wireless Network <br>
                                @else
                                    <i class="fa fa-square-o" aria-hidden="true"></i> Wireless Network <br>
                                @endif
                                @if($data->vpn == 1)
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i> VPN <br>
                                @else
                                    <i class="fa fa-square-o" aria-hidden="true"></i> VPN <br>
                                @endif
                                @if($data->fileshare == 1)
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i> File Share <br>
                                @else
                                    <i class="fa fa-square-o" aria-hidden="true"></i> File Share  <br>
                                @endif
                            </td>
                        </tr>
                        @if($data->fileshare == 1)
                        <tr>
                            <td>Folder Detail : </td>
                            <td>
                                {{$data->folder_detail}}
                            </td>
                        </tr>
                        @endif
                    @endif
                @endif

                @if($data->subject == 0 && $data->as400_user == 1)
                    <!-- AS400 User -->
                    <tr>
                        <td><b>AS400 User</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>User Detail : </td>
                        <td>
                            @if($data->workstation == 1)
                                <i class="fa fa-check-square-o" aria-hidden="true"></i> Work Station (If have not workstation don't check) <br>
                            @else
                                <i class="fa fa-square-o" aria-hidden="true"></i> Work Station (If have not workstation don't check)  <br>
                            @endif
                        </td>
                    </tr>
                    @if($data->workstation == 1)
                    <tr>
                        <td>Workstaion Number : </td>
                        <td>
                            {{$data->workstation_no}}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td>System : </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Remark : </td>
                        <td>
                            {{$data->remark_as400}}
                        </td>
                    </tr>
                @endif

            </table>
        </div>
    </div>
</div>