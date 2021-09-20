<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Facades\Excel;
class AttendanceExport implements WithHeadings, WithMapping, FromCollection
{

    protected $id;

 function __construct($id) {
        $this->id = $id;
    
 }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
    return [
            'User_id',
            'Check in',
            'Check out',
    ];
    }
    public function collection()
    {
        
        return Attendance::where('user_id',$this->id)->get();
    }
    public function map($code): array
    {
       return [
           $code->user_id,
           $code->check_in,
           $code->check_out,

       ];
    }
}
