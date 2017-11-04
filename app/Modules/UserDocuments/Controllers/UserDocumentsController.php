<?php

namespace App\Modules\UserDocuments\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use App\Classes\CommonFunctions;
use App\Modules\UserDocuments\Models\EmployeeDocuments;
use App\Modules\EmployeeDocuments\Models\MlstEmployeeDocuments;
use App\Classes\S3;

class UserDocumentsController extends Controller {

    public function index() {
        return view("UserDocuments::index");
    }

    public function getUsers() {

        $loggedInUserId = Auth::guard('admin')->user()->id;
        $employees = DB::table('laravel_developement_master_edynamics.mlst_bmsb_designations as db1')
                ->Join('laravel_developement_edynamics.employees as db2', 'db1.id', '=', 'db2.designation_id')
                ->select(["db2.first_name", "db2.last_name", "db2.id", "db1.designation"])
                ->where('db2.id', '!=', $loggedInUserId)->where('db2.deleted_status', '=', 0)->get();

        if (!empty($employees)) {
            $result = ['success' => true, 'records' => $employees];
        } else {
            $result = ['success' => false, 'message' => "No record"];
        }
        return json_encode($result);
    }

    public function getdocuments() {
        $result = MlstEmployeeDocuments::where('deleted_status', '=', 0)->get();
        if (!empty($result)) {
            $result = ['success' => true, 'records' => $result];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

    public function removeImage() {
        //$input = Input::all();
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true); 
        $remv = ['document_url'=>''];
        $removeImg =  EmployeeDocuments::where('id','=',$request)->update($remv);
        
        if($removeImg){
            $result = ['success' => true, 'message' => 'Document image removed successfully.'];
            return json_encode($result);
        }else{
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

    public function store() {
        $input = Input::all();

        $cnt = EmployeeDocuments::where(['document_id' => $input['document_id']])->where(['employee_id' => $input['employee_id']])->where('deleted_status', '=', 0)->get()->count();
        if ($cnt > 0) {
            $result = ['success' => false, 'errorMsgg' => 'Document already exists'];
            return json_encode($result);
        } else {
            if (!empty($input['documentUrl']['documentUrl'])) {
                $originalName = $input['documentUrl']['documentUrl']->getClientOriginalName();
                if ($originalName !== 'fileNotSelected') {

                    $s3FolderName = 'Employee-Documents';
                    $imageName = 'blog_' . rand(pow(10, config('global.randomNoDigits') - 1), pow(10, config('global.randomNoDigits')) - 1) . '.' . $input['documentUrl']['documentUrl']->getClientOriginalExtension();
                    S3::s3FileUpload($input['documentUrl']['documentUrl']->getPathName(), $imageName, $s3FolderName);
                    $document_url = $imageName;
                } else {
                    unset($input['documentUrl']);
                    $document_url = '';
                }
            }
            $doc = MlstEmployeeDocuments::where('id', $input['document_id'])->first();
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $common = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $create = array_merge($input, $common);
            $create['client_id'] = $loggedInUserId;
            $create['document_url'] = $document_url;
            $results = EmployeeDocuments::create($create);
            $last3 = EmployeeDocuments::latest('id')->first();

            return json_encode(['result' => $results, 'doc' => $doc->document_name, 'document_url' => $document_url, 'lastinsertid' => $last3->id, 'success' => true]);
        }
    }

    public function edit() {
        $input = Input::all();
       
        
//        $cnt = EmployeeDocuments::where(['document_id' => $input['document_id']])->where(['employee_id' => $input['employee_id']])->get()->count();
//        if ($cnt > 0) {
//            $result = ['success' => false, 'errorMsgg' => 'Document already exists'];
//            return json_encode($result);
//        } else {
        if (!empty($input['documentUrl']['documentUrl'])) {
            $originalName = ($input['documentUrl']['documentUrl'])->getClientOriginalName();
            $originalExtention = ($input['documentUrl']['documentUrl'])->getClientOriginalExtension();
            $originalpathName = ($input['documentUrl']['documentUrl'])->getPathName();
            
            if ($originalName !== 'fileNotSelected') {

                $s3FolderName = 'Employee-Documents';
                $imageName = 'blog_' . rand(pow(10, config('global.randomNoDigits') - 1), pow(10, config('global.randomNoDigits')) - 1) . '.' . $originalExtention;
                // echo "originalpathName= ".$originalpathName." imageName=". $imageName." s3FolderName". $s3FolderName;
                // die;
                S3::s3FileUpload($originalpathName, $imageName, $s3FolderName);
                $document_url = $imageName;                
            } else {
                unset($input['documentUrl']);
                $document_url = '';
            }
        }

        // }
        $doc = MlstEmployeeDocuments::where('id', $input['document_id'])->first();
        $loggedInUserId = Auth::guard('admin')->user()->id;
        $common = CommonFunctions::insertMainTableRecords($loggedInUserId);
        $create = array_merge($input, $common);
        $create['client_id'] = $loggedInUserId;
        $create['document_url'] = $document_url;
        unset($create['documentUrl']);
        $results = EmployeeDocuments::where('id', '=', $input['id'])->update($create);

        return json_encode(['result' => $results, 'doc' => $doc->document_name, 'document_url' => $document_url, 'success' => true]);

        //}
    }

    public function userDocumentLists() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        $userDocName = EmployeeDocuments::with(['userDocuments']);
        $users = EmployeeDocuments::with(['userDocuments'])->where('employee_id', '=', $request['employee_id'])->where('deleted_status', '=', 0)->get();
        //$users = EmployeeDocuments::join('laravel_developement_master_edynamics.mlst_employee_documents as mlst_employee_documents', 'mlst_employee_documents.id', '=', 'employee_documents.document_id')->where('employee_documents.employee_id', '=', $request['employee_id'])->get();
        return json_encode(['result' => $users, 'success' => true]);
    }

    //viveknk delete user documents
    public function delete () {
        $input = Input::all();

        $loggedInUserId = Auth::guard('admin')->user()->id;
        $common = CommonFunctions::deleteMainTableRecords($loggedInUserId);  
        $results = EmployeeDocuments::where('id', '=', $input['id'])->update($common);

        $userDocName = EmployeeDocuments::with(['userDocuments']);
        $users = EmployeeDocuments::with(['userDocuments'])->where('employee_id', '=', $input['employee_id'])->where('deleted_status', '=', 0)->get();
        return json_encode(['result' => $results, 'success' => true, 'record'=> $users, 'delAct'=> true ]);
    }

}
