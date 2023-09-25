<!-- Modal Detail -->
<div class="modal fade text-left" id="requestuserdt{{$data->no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable modal-xl" role="document">
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
                    <td width="25%"><b>Subject : </b></td>
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
                    <td><b>Section : </b></td>
                    <td>
                        {{$data->sect_name}}
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
                                    <a href="/file/request_user/attach_file/{{$arrAttachfile[$i]}}" target="_blank">Attach File {{$i+1}}</a><br>
                                @endfor
                            @endif 
                        @endif
                    </td>
                </tr>

                <!-- User Detail -->
                <tr>
                    <td><b>User Detail</b></td>
                    <td>{{$data->detail}}</td>
                </tr>
            </table>

            @php
                $arrPrefix = json_decode($data->prefix);
                $arrName = json_decode($data->name_user);
                $arrSurName = json_decode($data->surname_user);
                $arrEmployee = json_decode($data->employee_no);
                $arrPosition = json_decode($data->position);
                $arrEmailAD = json_decode($data->email_ad);
                $arrAS400 = json_decode($data->as400_user);
                $arrADOnly = json_decode($data->ad_only);
                $arrEmailOnly = json_decode($data->email_only);
                $arrWireless = json_decode($data->wireless);
                $arrVPN = json_decode($data->vpn);
                $arrFileshare = json_decode($data->fileshare);
                $arrFolderDetail = json_decode($data->folder_detail);
                $arrWorkstation = json_decode($data->workstation);
                $arrWorkstationNo = json_decode($data->workstation_no);

                $count = count($arrName);

                if(isset($arrEmailAD)){
                    $countEmailAD = count($arrEmailAD);
                }
                if(isset($arrAS400)){
                    $countAS400 = count($arrAS400);
                }
                if(isset($arrEmailOnly)){
                    $countEmailOnly = count($arrEmailOnly);
                }
                if(isset($arrADOnly)){
                    $countADOnly = count($arrADOnly);
                }
                if(isset($arrWireless)){
                    $countWireless = count($arrWireless);
                }
                if(isset($arrVPN)){
                    $countVPN = count($arrVPN);
                }
                if(isset($arrFileshare)){
                    $countFileshare = count($arrFileshare);
                }
                if(isset($arrWorkstation)){
                    $countWorkstation = count($arrWorkstation);
                }
                
            @endphp
            <table>
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No. </th>
                        <th width="205">Employee Number</th>
                        <th width="75%">Name</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=0;$i<$count;$i++)  
                        @php
                            $chkEmailAd = 1;
                            $chkAS400 = 1;
                            $chkEmailOnly = 1;
                            $chkADOnly = 1;
                            $chkWireless = 1;
                            $chkVPN = 1;
                            $chkFileshare = 1;
                            $chkWorkStation = 1;

                            $stEmailAd = 1;
                            $stAS400 = 1;
                            $stFileshare = 1;
                            $stWorkstation = 1;
                        @endphp  
                        <tr>
                            <td class="text-center">{{$i+1}}</td>
                            <td>
                                {{$arrEmployee[$i]}}<br>

                                <b>User Access</b>
                                @if($data->email_ad == "null")
                                    <div class="form">
                                        <i class="fa fa-square-o" aria-hidden="true"></i> Email and AD user
                                    </div>
                                @else
                                    @for($x=0;$x<$countEmailAD;$x++)
                                        @if($chkEmailAd != 2)
                                            @if(substr($arrEmailAD[$x], -1) == $i+1)
                                                <div class="form">
                                                    <i class="fa fa-check-square-o" aria-hidden="true"></i> Email and AD user
                                                </div>
                                                @php
                                                    $chkEmailAd = 2;
                                                    $stEmailAd = 2;
                                                @endphp
                                            @endif
                                        @endif
                                    @endfor

                                    @if($chkEmailAd == 1)
                                        <div class="form">
                                            <i class="fa fa-square-o" aria-hidden="true"></i> Email and AD user
                                        </div>
                                    @endif
                                @endif

                                @if($data->as400_user == "null")
                                    <div class="form">
                                        <i class="fa fa-square-o" aria-hidden="true"></i> AS400 User
                                    </div>
                                @else
                                    @for($x=0;$x<$countAS400;$x++)
                                        @if($chkAS400 != 2)
                                            @if(substr($arrAS400[$x], -1) == $i+1)
                                                <div class="form">
                                                    <i class="fa fa-check-square-o" aria-hidden="true"></i> AS400 User
                                                </div>
                                                @php
                                                    $chkAS400 = 2;
                                                    $stAS400 = 2;
                                                @endphp
                                            @endif
                                        @endif
                                    @endfor

                                    @if($chkAS400 == 1)
                                        <div class="form">
                                            <i class="fa fa-square-o" aria-hidden="true"></i> AS400 User
                                        </div>
                                    @endif
                                @endif

                                @if($data->email_only == "null")
                                    <div class="form">
                                        <i class="fa fa-square-o" aria-hidden="true"></i> Email Only
                                    </div>
                                @else
                                    @for($x=0;$x<$countEmailOnly;$x++)
                                        @if($chkEmailOnly != 2)
                                            @if(substr($arrEmailOnly[$x], -1) == $i+1)
                                                <div class="form">
                                                    <i class="fa fa-check-square-o" aria-hidden="true"></i> Email Only
                                                </div>
                                                @php
                                                    $chkEmailOnly = 2;
                                                @endphp
                                            @endif
                                        @endif
                                    @endfor

                                    @if($chkEmailOnly == 1)
                                        <div class="form">
                                            <i class="fa fa-square-o" aria-hidden="true"></i> Email Only
                                        </div>
                                    @endif
                                @endif

                                @if($data->ad_only == "null")
                                    <div class="form">
                                        <i class="fa fa-square-o" aria-hidden="true"></i> AD User Only
                                    </div>
                                @else
                                    @for($x=0;$x<$countADOnly;$x++)
                                        @if($chkADOnly != 2)
                                            @if(substr($arrADOnly[$x], -1) == $i+1)
                                                <div class="form">
                                                    <i class="fa fa-check-square-o" aria-hidden="true"></i> AD User Only
                                                </div>
                                                @php
                                                    $chkADOnly = 2;
                                                @endphp
                                            @endif
                                        @endif
                                    @endfor

                                    @if($chkADOnly == 1)
                                        <div class="form">
                                            <i class="fa fa-square-o" aria-hidden="true"></i> AD User Only
                                        </div>
                                    @endif
                                @endif

                            </td>
                            <td>
                                {{App\Http\Controllers\RequestUserController::getPrefix($arrPrefix[$i])}}{{$arrName[$i]}} {{$arrSurName[$i]}} ({{$arrPosition[$i]}}) <br>
                                @if($data->subject == 0)
                                    @if($stEmailAd == 2 || $chkADOnly == 2)
                                        <b>Permission</b>
                                        @if($data->wireless == "null")
                                            <div class="form">
                                                <i class="fa fa-square-o" aria-hidden="true"></i> Wireless
                                            </div>
                                        @else
                                            @for($x=0;$x<$countWireless;$x++)
                                                @if($chkWireless != 2)
                                                    @if(substr($arrWireless[$x], -1) == $i+1)
                                                        <div class="form">
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i> Wireless
                                                        </div>
                                                        @php
                                                            $chkWireless = 2;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endfor

                                            @if($chkWireless == 1)
                                                <div class="form">
                                                    <i class="fa fa-square-o" aria-hidden="true"></i> Wireless
                                                </div>
                                            @endif
                                        @endif

                                        @if($data->vpn == "null")
                                            <div class="form">
                                                <i class="fa fa-square-o" aria-hidden="true"></i> VPN
                                            </div>
                                        @else
                                            @for($x=0;$x<$countVPN;$x++)
                                                @if($chkVPN != 2)
                                                    @if(substr($arrVPN[$x], -1) == $i+1)
                                                        <div class="form">
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i> VPN
                                                        </div>
                                                        @php
                                                            $chkVPN = 2;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endfor

                                            @if($chkVPN == 1)
                                                <div class="form">
                                                    <i class="fa fa-square-o" aria-hidden="true"></i> VPN
                                                </div>
                                            @endif
                                        @endif

                                        @if($data->fileshare == "null")
                                            <div class="form">
                                                <i class="fa fa-square-o" aria-hidden="true"></i> File Share
                                            </div>
                                        @else
                                            @for($x=0;$x<$countFileshare;$x++)
                                                @if($chkFileshare != 2)
                                                    @if(substr($arrFileshare[$x], -1) == $i+1)
                                                        <div class="form">
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i> File Share
                                                        </div>
                                                        @php
                                                            $chkFileshare = 2;
                                                            $stFileshare = 2;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endfor

                                            @if($chkFileshare == 1)
                                                <div class="form">
                                                    <i class="fa fa-square-o" aria-hidden="true"></i> File Share
                                                </div>
                                            @endif
                                        @endif

                                        @if($stFileshare == 2)
                                            <b>Folder Detail</b> <br>
                                            {{$arrFolderDetail[$i]}} <br>
                                        @endif
                                    @endif
                                @endif

                                @if($data->subject == 0)
                                    @if($stAS400 == 2)
                                        <b>AS400 User</b>

                                        @if($data->workstation == "null")
                                            <div class="form">
                                                <i class="fa fa-square-o" aria-hidden="true"></i> Work Station (If have not workstation don't check)
                                            </div>
                                        @else
                                            @for($x=0;$x<$countWorkstation;$x++)
                                                @if($chkWorkStation != 2)
                                                    @if(substr($arrWorkstation[$x], -1) == $i+1)
                                                        <div class="form">
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i> Work Station (If have not workstation don't check)
                                                        </div>
                                                        @php
                                                            $chkWorkStation = 2;
                                                            $stWorkstation = 2
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endfor

                                            @if($chkWorkStation == 1)
                                                <div class="form">
                                                    <i class="fa fa-square-o" aria-hidden="true"></i> Work Station (If have not workstation don't check)
                                                </div>
                                            @endif

                                            @if($stWorkstation == 2)
                                                <b>Work Station Number</b> <br>
                                                {{$arrWorkstationNo[$i]}}
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
       
    </div>
</div>