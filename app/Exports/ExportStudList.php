<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStudList implements FromCollection, ShouldAutoSize, WithHeadings
{
    
    public function __construct($isGraduated, $isEpoxrtAll, Request $request, )
    {
        $this->isGraduated = $isGraduated;
        $this->isExportAll = $isEpoxrtAll;
        $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->isExportAll){
            return $this->exportAllStudents();
        }else{
            return $this->exportStudents($this->request);
        }
        
    }

    public function exportStudents(Request $request){
        $studentCollection = Student::select(
            'student_id',
            'last_name',
            'first_name',
            'middle_name',
            'dept_name',
            'course_name'
        )->leftJoin(
            'users', 'users.user_id', '=', 'students.student_id'
        )->leftJoin(
            'departments', 'departments.department_id', '=', 'students.department_id'
        )->leftJoin(
            'courses', 'courses.course_id', '=', 'students.course_id'
        );


        if(!is_null($request->input('department_id'))){
            $studentCollection->where(
                'students.department_id', $request->input('department_id')
            );
        }
        
        if(!is_null($request->input('admissionYear'))){
            $studentCollection->where(
                'admission_year', $request->input('admissionYear')
            );
        }

        if(!is_null($request->input('status'))){
            $studentCollection->where('status', $request->input('status'));
        }

        if($this->isGraduated){
            $studentCollection->where('status', 2);
        }

        return $studentCollection->orderBy('last_name', 'ASC')->get();
    }

    public function exportAllStudents(){
        $studentCollection = Student::select(
            'student_id',
            'last_name',
            'first_name',
            'middle_name',
            'dept_name',
            'course_name'
        )->leftJoin(
            'users', 'users.user_id', '=', 'students.student_id'
        )->leftJoin(
            'departments', 'departments.department_id', '=', 'students.department_id'
        )->leftJoin(
            'courses', 'courses.course_id', '=', 'students.course_id'
        );

        if($this->isGraduated){
            $studentCollection->where('status', 2);
        }

        return $studentCollection->orderBy('last_name', 'ASC')->get();
    }

    public function headings() : array{
        return [
            'Student ID',
            'Last Name',
            'First Name',
            'Middle Name',
            'Program',
            'Course'
        ];
    }
}
