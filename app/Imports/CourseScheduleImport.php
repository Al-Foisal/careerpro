<?php

namespace App\Imports;

use App\Models\CourseSchedule;
use Maatwebsite\Excel\Concerns\ToModel;

class CourseScheduleImport implements ToModel {
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        return new CourseSchedule([
            'name'            => $row[0],
            'instructor_name' => $row[1],
            'time_length'     => $row[2],
        ]);
    }
}
