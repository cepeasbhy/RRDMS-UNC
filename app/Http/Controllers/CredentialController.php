<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credential;
use Illuminate\Support\Facades\File;

class CredentialController extends Controller
{
    public function uploadStudentCredentials(Request $request)
    {
        if ($request->hasFile('picture')){
            $this->saveCredential($request, 'picture', 'Picture');
        }

        if ($request->hasFile('birthCertificate')){
            $this->saveCredential($request, 'birthCertificate', 'Birth Certificate');
        }

        if ($request->hasFile('marriageCertificate')){
            $this->saveCredential($request, 'marriageCertificate', 'Marriage Certificate');
        }

        if ($request->hasFile('goodMoralCharacter')){
            $this->saveCredential($request, 'goodMoralCharacter', 'Certificate of Good Moral Character');
        }

        if ($request->hasFile('honorDismisal')){
            $this->saveCredential($request, 'honorDismisal', 'Honorable Dismisal');
        }

        if ($request->hasFile('form137')){
            $this->saveCredential($request, 'form137', 'Form 137');
        }

        if ($request->hasFile('form138')){
            $this->saveCredential($request, 'form138', 'Form 138');
        }

        if ($request->hasFile('copyGrade')){
            $this->saveCredential($request, 'copyGrade', 'Copy of Grades');
        }

        if ($request->hasFile('tor')){
            $this->saveCredential($request, 'tor', 'Transcript of Record');
        }

        if ($request->hasFile('NbiClearance')){
            $this->saveCredential($request, 'NbiClearance', 'NBI Clearance');
        }

        if ($request->hasFile('PoliceClearance')){
            $this->saveCredential($request, 'PoliceClearance', 'Police Clearance');
        }

        if ($request->hasFile('C1')){
            $this->saveCredential($request, 'C1', 'C1 Receipt');
        }

        if ($request->hasFile('permitCrossEnroll')){
            $this->saveCredential($request, 'permitCrossEnroll', 'Permit to Cross Enroll');
        }
    }

    public function saveCredential($request, $keyName, $fileName){

        $folderPath = '';

        if($keyName == 'picture'){
            $folderPath = 'Picture';
        }else{
            $folderPath = $request->student_id;
        }

        $docPath = $request->file($keyName)->storeAs(
            $folderPath,
            '['.$request->student_id.'] '.$fileName.'.'.$request->file($keyName)->getClientOriginalExtension(),
            'public'
        );

        $id = 'DOC'.'-'.date("Y")."_".random_int(0, 1000)+random_int(0, 1000);

        Credential::create([
            'document_id' => $id,
            'student_id' => $request->input('student_id'),
            'input_name' => $keyName,
            'document_name' => $fileName,
            'document_loc' => $docPath
        ]);

    }

    public function deleteAllStudCreds($studentID){

        $picturePath = $this->getStudentPicture($studentID);
        File::deleteDirectory(storage_path('app\public\\'.$studentID));
        unlink(storage_path('app\public\\'.$picturePath->document_loc));
        Credential::where('student_id', $studentID)->delete();
    }

    public function deleteCredential($docID){

        $credential = Credential::select(
             'document_loc'
         )->where('document_id', $docID)->firstOrFail();
 
         unlink(storage_path('app\public\\'.$credential->document_loc));
 
         Credential::where('document_id', $docID)->delete();
    }

    public function updateCredential($request, $studID, $docID){

        $credential = Credential::where('document_id', $docID)->firstOrFail();
        unlink(storage_path('app\public\\'.$credential->document_loc));
        if($credential->input_name == 'picture'){
            $folderPath = 'Picture';
        }else{
            $folderPath = $studID;
        }

        $newPath = $request->file($credential->input_name)->storeAs(
                    $folderPath,
                    '['.$studID.'] '.$credential->document_name.'.'.$request->file($credential->input_name)->getClientOriginalExtension(),
                    'public'
                );

        Credential::where('document_id', $docID)->update([
            'document_loc' => $newPath
        ]);
    }

    public function getStudentPicture($id){
        return Credential::select('document_id','document_loc')->where(
            'student_id', $id,
            )->where(
            'document_name', 'Picture'
            )->firstOrFail();
    }

    public function getStudentCredenials($id){
        return Credential::select(
            'document_id',
            'document_name',
            'input_name',
            'document_loc'
        )->where(
            'student_id', $id,
        )->get();
    }

    public function archiveCredentials($studentID){
        $unnecessaryCredentials = Credential::select(
            'document_loc'
            )->where('student_id', $studentID)->whereNotIn('document_name',[
                'Birth Certificate',
                'Form 137',
                'Transcript of Record',
                'Form 9',
                'Picture'
            ])->get();

        foreach($unnecessaryCredentials as $creds){
            unlink(storage_path('app\public\\'.$creds->document_loc));
        }

        Credential::where('student_id', $studentID)->whereNotIn('document_name',
        ['Birth Certificate', 'Picture', 'Form 137', 'Form 9', 'Transcript of Record'])->delete();
    }
}
