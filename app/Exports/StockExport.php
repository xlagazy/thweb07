<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;

class StockExport implements FromCollection, WithHeadings
{
    protected $com_id;
    protected $stock_status;

    function __construct($com_id, $stock_status){
        $this->com_id = $com_id;
        $this->stock_status = $stock_status;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            "Equipment No",
            "Equipment Name",
            "Computer Type", 
            "Status"
        ];
    }

    public function collection()
    {
        return collect(DB::select('select st.equipment_no, eq.equipment_name, ct.com_name, ss.stock_status_name
                                    from stock st
                                    inner join equipment eq
                                    on st.equipment_no = eq.equipment_no
                                    inner join com_type ct
                                    on eq.com_id = ct.com_id
                                    inner join stock_status ss
                                    on st.stock_status = ss.stock_status_no
                                    where eq.com_id = ? and st.stock_status = ? order by equipment_no', [$this->com_id, $this->stock_status]));
    }
}
