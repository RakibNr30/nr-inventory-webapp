<?php

namespace App\Imports;

use App\Helpers\SmsManager;
use App\StudentDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Modules\Cms\Entities\StudentGuardian;
use Modules\Ums\Entities\Student;

class ResultImport implements WithStartRow, ToModel
{
    public function startRow(): int
    {
        return 2;
    }

    protected $data;
    protected $id;

    public function __construct($data, $id)
    {
        $this->data = $data;
        $this->id = $id;
    }

    public function model(array $row)
    {
        $student_detail = \Modules\Cms\Entities\StudentDetail::updateOrCreate([
            'student_id' => $row[0],
            'semester_id' => $this->data['semester_id'],
            'exam_session_id' => $this->data['session_id']
        ], [
            'student_id' => $row[0],
            'semester_id' => $this->data['semester_id'],
            'exam_session_id' => $this->data['session_id'],
            'exam_year' => $this->data['exam_year'],
            'semester_cgpa' => $row[6],
            'total_credits' => $row[2],
            'earned_credits' => $row[3],
            'failed_courses' => $row[5],
            'result_id' => $this->id
        ]);

        $student = Student::updateOrCreate([
            'student_id' => $row[0]
        ], [
            'student_id' => $row[0],
            'name' => $row[1],
            'faculty_id' => 1,
            'department_id' => 1,
            'session_id' => $this->data['session_id'],
            'semester_id' => $this->data['semester_id'],
        ]);

        $student_guardian = StudentGuardian::updateOrCreate([
            'student_id' => $row[0]
        ], [
            'student_id' => $row[0],
            'primary_phone_no' => $row[7],
        ]);
    }
}
