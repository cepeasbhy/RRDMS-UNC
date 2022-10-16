<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Credential;
use Illuminate\Support\Facades\File;

class StudentCredential extends Controller
{
    public function index(){
        $students = Student::select(
            'student_id',
            'first_name',
            'last_name',
            'dept_name',
            'course_name',
        )->leftJoin(
            'departments', 'departments.department_id', '=', 'students.department_id'
        )->leftJoin(
            'courses', 'courses.course_id', '=', 'students.course_id'
        )->get();

        return view('StudentCredential/index', ['students' => $students]);
    }

    public function addStudent(){
        return view('StudentCredential/add_stud');
    }

    public function create(Request $request){
        $request -> validate([
            'student_id' => ['required', 'string', 'unique:students'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'middle_name' => ['required', 'string'],
            'admission_year' => ['required', 'integer', 'min:1948'],
            'course_id' => ['nullable', 'string'],
            'department_id' => ['required', 'string'],
        ]);

        Student::create([
            'student_id' => $request->input('student_id'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'middle_name' => $request->input('middle_name'),
            'admission_year' => $request->input('admission_year'),
            'course_id' => $request->input('course_id'),
            'department_id' => $request->input('department_id')
        ]);

        $this->saveCredentials($request);

        return redirect('/stud_cred_mngmnt')->with('msg', 'Student Successfully Added');
    }

    public function saveCredentials($request){
        if($request->hasFile('picture')){$this->saveFile($request, 'picture', 'Picture');}
        if($request->hasFile('birthCertificate')){$this->saveFile($request, 'birthCertificate', 'Birth Certificate');}
        if($request->hasFile('marriageCertificate')){$this->saveFile($request, 'marriageCertificate', 'Marriage Certificate');}
        if($request->hasFile('goodMoralCharacter')){$this->saveFile($request, 'goodMoralCharacter', 'Certificate of Good Moral Character');}
        if($request->hasFile('honorDismisal')){$this->saveFile($request, 'honorDismisal', 'Honorable Dismisal');}
        if($request->hasFile('form137')){$this->saveFile($request, 'form137', 'Form 137');}
        if($request->hasFile('form138')){$this->saveFile($request, 'form138', 'Form 138');}
        if($request->hasFile('copyGrade')){$this->saveFile($request, 'copyGrade', 'Copy of Grades');}
        if($request->hasFile('tor')){$this->saveFile($request, 'tor', 'Transcript of Record');}
        if($request->hasFile('clearance')){$this->saveFile($request, 'clearance', 'NBI or Police Clearance');}
        if($request->hasFile('C1')){$this->saveFile($request, 'C1', 'C1 Receipt');}
        if($request->hasFile('permitCrossEnroll')){$this->saveFile($request, 'permitCrossEnroll', 'Permit to Cross Enroll');}
    }

    public function saveFile($request, $keyName, $fileName){
        $docPath = $request->file($keyName)->storeAs(
            $request->student_id,
            '['.$request->student_id.'] '.$fileName.'.'.$request->file('picture')->getClientOriginalExtension(),
            'public'
        );

        $id = 'DOC'.'-'.date("Y")."_".random_int(0, 1000)+random_int(0, 1000);

        Credential::create([
            'document_id' => $id,
            'student_id' => $request->input('student_id'),
            'document_name' => $fileName,
            'document_loc' => $docPath
        ]);

    }
    
    public function viewStudent($id){
        $student = Student::select(
            'student_id',
            'first_name',
            'last_name',
            'middle_name',
            'dept_name',
            'course_name',
            'admission_year'
        )->leftJoin(
            'departments', 'departments.department_id', '=', 'students.department_id'
        )->leftJoin(
            'courses', 'courses.course_id', '=', 'students.course_id'
        )->where('student_id', $id)->firstOrFail();


        $credentials = [];
        if(File::isDirectory(storage_path('app\public\\'.$id))){
            $credentials = File::files(storage_path('app\public\\'.$id));
        }
        return view('StudentCredential/view_stud', ['student' => $student, 'credentials' => $credentials]);
    }

    public function update($id, Request $request){
        $request -> validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'middle_name' => ['required', 'string'],
            'admission_year' => ['required', 'integer', 'min:1948'],
            'course_id' => ['nullable', 'string'],
            'department_id' => ['required', 'string'],
        ]);

        Student::where('student_id', $id)->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'middle_name' => $request->input('middle_name'),
            'department_id' => $request->input('department_id'),
            'course_id' => $request->input('course_id'),
            'admission_year' => $request->input('admission_year'),
        ]);

        return redirect('/stud_cred_mngmnt/view_student/'.$id)->with('msg', 'Student Information Successfully Updated');
    }

    public function destroy($id){
        Credential::where('student_id', $id)->delete();
        Student::where('student_id', $id)->delete();
        File::deleteDirectory(storage_path('app\public\\'.$id));

        return redirect('/stud_cred_mngmnt')->with('msg', 'Student successfully removed from the record');
    }

}
