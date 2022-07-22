<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use DB;

class BorrowExport implements FromCollection, WithHeadings
{
    protected $start_date;
    protected $end_date;

    function __construct($start_date, $end_date){
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            "Equipment No",
            "Equipment Name",
            "Computer Type",
            "User Borrow",
            "Section",
            "Start Date",
            "End Date", 
            "Charge",
            "Status"
        ];
    }

    public function collection()
    {
        return collect(DB::select('select br.equipment_no, eq.equipment_name, ct.com_name, user_borrow, st.sect_name, start_date, end_date,
                                   mb.name, bs.borrow_status_name
                                   from borrow br
                                   inner join equipment eq
                                   on br.equipment_no = eq.equipment_no
                                   inner join com_type ct
                                   on eq.com_id = ct.com_id
                                   inner join section st
                                   on br.sect_id = st.sect_id
                                   inner join member mb
                                   on br.charge = mb.user_id
                                   inner join borrow_status bs
                                   on bs.borrow_status_no = br.borrow_status
                                   where start_date between ? and ? ', [$this->start_date, $this->end_date]));
    }
}
