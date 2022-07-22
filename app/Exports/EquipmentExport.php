<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;

class EquipmentExport implements FromCollection, WithHeadings
{
    protected $id;
    protected $com_id;

    function __construct($id, $com_id) {
        $this->id = $id;
        $this->com_id = $com_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array
    {
        return[
            "Equipment No",
            "Equipment Name",
            "Fix Asset", 
            "Serial Number",
            "O/S",
            "Computer Type",
            "Location",
            "Setup Date",
            "Warranty",
            "Control Person",
            "Person in Charge",
            "Equipment Status",
            "Equipment Type",
            "Spec",
            "Remark"
        ];
    }
    public function collection()
    {
        return collect(DB::select('select equipment_no, equipment_name, fix_asset, serial_number,
                                    (select os_name from os where os_id = eq.os_id) as os_name,
                                    (select com_name from com_type where com_id = eq.com_id) as com_name,
                                    location, setup_date, warranty, control_person,
                                    (select name from member where user_id = person_in_charge) as name,
                                    equipment_status,
                                    (select equip_type_name from equipment_type where equip_type_id = eq.equip_type_id) as equip_type_name,
                                    spec, remark
                                    from equipment eq
                                    where eq.equip_type_id = ? and eq.com_id = ? order by equipment_no', [$this->id, $this->com_id]));
    }
}
