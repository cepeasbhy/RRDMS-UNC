<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DbHelperController;
use Illuminate\Http\Request;
use App\Models\Credential;
use Illuminate\Support\Facades\File;

class CredentialController extends Controller
{
    public function uploadStudentCredentials(Request $request)
    {
        $descriptions = [
            'Picture' => 'picture',
            'Birth Certificate' => 'birthCertificate',
            'Marriage Certificate' => 'marriageCertificate',
            'Certificate of Good Moral Character' => 'goodMoralCharacter',
            'Honorable Dismisal' => 'honorDismisal',
            'Form 137' => 'form137',
            'Form 138' => 'form138',
            'Copy of Grades' => 'copyGrade',
            'Transcript of Record' => 'tor',
            'NBI Clearance' => 'NbiClearance',
            'Police Clearance' => 'PoliceClearance',
            'C1 Receipt' => 'C1',
            'Permit to Cross Enroll' => 'permitCrossEnroll'
        ];

        foreach ($descriptions as $fileName => $keyName) {
            if ($request->hasFile($keyName)) {
                $this->saveCredential($request, $keyName, $fileName);
            }
        }
    }

    public function saveCredential($request, $keyName, $fileName)
    {

        $folderPath = '';

        if ($keyName == 'picture') {
            $folderPath = 'Picture';
        } else {
            $folderPath = 'credentials/' . $request->student_id;
        }

        $docPath = $request->file($keyName)->storeAs(
            $folderPath,
            '[' . $request->student_id . '] ' . $fileName . '.' . $request->file($keyName)->getClientOriginalExtension(),
            'public'
        );

        $id = 'DOC' . '-' . date("Y") . "_" . substr(uniqid(), 9, 12);;

        Credential::create([
            'document_id' => $id,
            'student_id' => $request->input('student_id'),
            'input_name' => $keyName,
            'document_name' => $fileName,
            'document_loc' => $docPath
        ]);
    }

    public function deleteAllStudCreds($studentID)
    {

        $picturePath = $this->getStudentPicture($studentID);
        File::deleteDirectory(storage_path('app\public\credentials\\' . $studentID));
        unlink(storage_path('app\public\\' . $picturePath->document_loc));
        Credential::where('student_id', $studentID)->delete();
    }

    public function deleteCredential($docID)
    {
        $db = new DbHelperController;

        $credential = Credential::select(
            'document_loc',
            'student_id',
            'document_name'
        )->where('document_id', $docID)->firstOrFail();

        unlink(storage_path('app\public\\' . $credential->document_loc));

        Credential::where('document_id', $docID)->delete();

        $description = "Deleted " . $credential->document_name . " associated to student with an ID of " . $credential->student_id;
        $db->createLog($description);
    }

    public function updateCredential($request, $studID, $docID)
    {

        $db = new DbHelperController;
        $credential = Credential::where('document_id', $docID)->firstOrFail();
        unlink(storage_path('app\public\\' . $credential->document_loc));
        if ($credential->input_name == 'picture') {
            $folderPath = 'Picture';
        } else {
            $folderPath = 'credentials/' . $studID;
        }

        $newPath = $request->file($credential->input_name)->storeAs(
            $folderPath,
            '[' . $studID . '] ' . $credential->document_name . '.' . $request->file($credential->input_name)->getClientOriginalExtension(),
            'public'
        );

        Credential::where('document_id', $docID)->update([
            'document_loc' => $newPath
        ]);

        $description = "Updated " . $credential->document_name . " associated to student with an ID of " . $credential->student_id;
        $db->createLog($description);
    }

    public function getStudentPicture($id)
    {
        return Credential::select('document_id', 'document_loc')->where(
            'student_id',
            $id,
        )->where(
            'document_name',
            'Picture'
        )->firstOrFail();
    }

    public function getStudentCredenials($id)
    {
        return Credential::select(
            'document_id',
            'document_name',
            'input_name',
            'document_loc'
        )->where(
            'student_id',
            $id,
        )->get();
    }

    public function archiveCredentials($studentID)
    {
        $unnecessaryCredentials = Credential::select(
            'document_loc'
        )->where('student_id', $studentID)->whereNotIn('document_name', [
            'Birth Certificate',
            'Form 137',
            'Transcript of Record',
            'Form 9',
            'Picture'
        ])->get();

        foreach ($unnecessaryCredentials as $creds) {
            unlink(storage_path('app\public\\' . $creds->document_loc));
        }

        Credential::where('student_id', $studentID)->whereNotIn(
            'document_name',
            ['Birth Certificate', 'Picture', 'Form 137', 'Form 9', 'Transcript of Record']
        )->delete();
    }
}
