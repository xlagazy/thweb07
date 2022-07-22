<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;

class SoftwareExport implements FromCollection, WithHeadings
{

    function __construct(){

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            "Software Name",
            "Software Version",
            "Key License", 
            "Software Type",
            "Platform",
            "Used License",
            "Max License",
            "Start Date",
            "End Date",
            "Charge"
        ];
    }

    public function collection()
    {
        return collect(DB::select('select sw.software_name, sw.software_version, sw.key_license, st.software_type_name,
                                    pf.platform_name, sw.used_license, sw.max_license, sw.start_date, sw.end_date, mb.name
                                    from software sw
                                    inner join software_type st
                                    on sw.software_type_no = st.software_type_no
                                    inner join platform pf
                                    on sw.platform_no = pf.platform_no
                                    inner join member mb
                                    on sw.user_id = mb.user_id'));
    }
}
