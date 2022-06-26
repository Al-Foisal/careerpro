<?php

namespace App\Exports;

use App\Models\CourseSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;

class CourseScheduleExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CourseSchedule::all();
    }
}
