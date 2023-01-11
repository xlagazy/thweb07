@extends('notifyrepair.master_notifyrepair')
@section('contents')
<h2 class="text-center">IT Request User Control</h2>

        <div class="border">
            <form action="/addrequestuser" method="post" enctype="multipart/form-data" class="frm">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <!-- group subject -->
                <div id="subject">
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0"><b>Subject (หัวข้อ)</b></legend>                    
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="subject" id="add" value="0" checked>
                                <label class="form-check-label" for="add">
                                    Add
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="subject" id="delete" value="1">
                                <label class="form-check-label" for="delete">
                                    Delete
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="subject" id="change" value="2">
                                <label class="form-check-label" for="change">
                                    Change
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="useraccess">
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0"><b>User Access <br>(การเข้าถึง)</b></legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="emailad" id="email-ad" value="1">
                                <label class="form-check-label" for="email-ad">
                                    Email and AD user
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="as400" id="as400" value="1">
                                <label class="form-check-label" for="as400">
                                    AS400 User
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="emailonly" id="emailonly" value="1">
                                <label class="form-check-label" for="emailonly">
                                    Email Only
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="adonly" id="adonly" value="1">
                                <label class="form-check-label" for="adonly">
                                    AD User Only
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Effective date<br>(มีผลตั้งแต่วันที่)</b></legend>
                    <div class="col-sm-10">           
                        <input type="date" name="effective_date" id="effective_date" value=""  class="form-control" required />
                        <div class="invalid-feedback">Please input data</div>   
                    </div>
                </div>

                <!-- group user -->
                <div id="hidden_user">
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-4 pt-0"><b>User Detail (รายละเอียดผู้ใช้งาน)</b></legend>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">Employee Number <br> (รหัสพนักงาน)</legend>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="employee_no" id="employee_no" placeholder="Employee Number">
                            <div class="invalid-feedback">Please input data</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">Prefix <br> (คำนำหน้าชื่อ)</legend>
                        <div class="col-sm-10">
                            <select name="prefix_id" id="prefix_id" class="form-control">
                            <option disabled selected value>Choose...</option>
                                @foreach($prefix as $prefixs)
                                    <option value="{{$prefixs->prefix_id}}">{{$prefixs->prefix_name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please choose data</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">Name <br> (ชื่อ)</legend>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                            <div class="invalid-feedback">Please input data</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">Surname (นามสกุล)</legend>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="surname" id="surname" placeholder="Surname">
                            <div class="invalid-feedback">Please input data</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">Position <br> (ตำแหน่ง)</legend>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="position" id="position" placeholder="Position">
                            <div class="invalid-feedback">Please input data</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">Section <br> (แผนก)</legend>
                        <div class="col-sm-10">
                            <select name="sect_id" id="sect_id" class="form-control">
                            <option disabled selected value>Choose...</option>
                                @foreach($section as $sections)
                                    <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please choose data</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">Remark <br> (หมายเหตุ)</legend>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="remark" rows="3"></textarea>
                            <div class="invalid-feedback">Please input data</div>
                        </div>
                    </div>
                </div>

                <!-- group ad -->
                <div id="hidden_ad">
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0"><b>Permission AD</b></legend>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">Permission</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="wireless" id="wireless" value="1">
                                <label class="form-check-label" for="wireless">
                                    Wireless Network
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vpn" id="vpn" value="1">
                                <label class="form-check-label" for="vpn">
                                    VPN
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fileshare" id="fileshare" value="1">
                                <label class="form-check-label" for="fileshare">
                                    File Share
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="hidden_folder">
                        <div class="form-group row">  
                            <legend class="col-form-label col-sm-2 pt-0">Folder Detail</legend>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="folderdetail" name="folderdetail" rows="3"></textarea>
                                <div class="invalid-feedback">Please input data</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- group as400 -->
                <div id="hidden_as400">
                    
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0"><b>AS400 User</b></legend>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">User Detail</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="workstation" id="workstation" value="1">
                                <label class="form-check-label" for="workstation">
                                    Work Station (If have not workstation don't check)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="hidden_workstation">
                        <div class="form-group row">
                            <legend class="col-form-label col-sm-2 pt-0">Workstaion Number</legend>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="workstation_no" id="workstation_no" placeholder="Work Station Number">
                                <div class="invalid-feedback">Please input data</div>
                            </div>  
                        </div>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">System</legend>
                        <div class="col-sm-10">
                            <select name="system_as400" id="system_as400" class="form-control">
                                <option selected value>Choose...</option>
                            </select>
                            <div class="invalid-feedback">Please choose data</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0">Remark</legend>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="remark_as400" rows="3"></textarea>
                            <div class="invalid-feedback">Please input data</div>
                        </div>
                    </div>
                </div>

                <div id="hidden_button" class="text-right">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                    <button type="button" name="btn2" class="btn btn-success addrequestuser">Request</button>
                </div>
                
            </form>
        </div>

    <script src="/scripts/showdiv_request_user.js"></script>
    <script src="/scripts/addrequestuser.js"></script>

@endsection