<?php

namespace App\Modules\EmployeeDocuments\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\EmployeeDocuments\Models\MlstEmployeeDocuments;
use Illuminate\Http\Request;
use Auth;
use Excel;
use App\Classes\CommonFunctions;

class EmployeeDocumentsController extends Controller {

    public function index() {
        return view("EmployeeDocuments::index");
    }

    public function employeeDocuments() {
        $result = MlstEmployeeDocuments::where('deleted_status', '=', 0)->get();
        if (!empty($result)) {
            $result = ['success' => true, 'records' => $result];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

    public function store() {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = MlstEmployeeDocuments::where(['document_name' => $request['document_name']])->get()->count();
        if ($cnt > 0) {
            $result = ['success' => false, 'errorMsg' => 'Document name already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['documentData'] = array_merge($request, $create);
            $document = MlstEmployeeDocuments::create($input['documentData']);
            $last3 = MlstEmployeeDocuments::latest('id')->first();
            $result = ['success' => true, 'result' => $document, 'lastinsertid' => $last3->id];
            return json_encode($result);
        }
    }

    public function update($id) {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);
        $getCount = MlstEmployeeDocuments::where(['document_name' => $request['document_name']])
                ->where('id', '!=', $id)
                ->get()
                ->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errorMsg' => 'Document name already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['documentData'] = array_merge($request, $create);
            $result = MlstEmployeeDocuments::where('id', $id)->update($input['documentData']);
            $result = ['success' => true, 'result' => $input['documentData']];
            return json_encode($result);
        }
    }

    public function destroy($id) {

        $getDocuments = MlstEmployeeDocuments::where('id', '=', $id)->get();
        $getCount = $getDocuments->count();

        if ($getCount < 1) {
            $result = ['success' => false, 'errorMsg' => 'Document can not be deleted.'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['documentData'] = $delete;
            $result = MlstEmployeeDocuments::where('id', $id)->update($input['documentData']);
            $getDocuments = MlstEmployeeDocuments::where('deleted_status', '=', 0)->get();        
            $result = ['success' => true, 'result' => $result, 'records' => $getDocuments ];
            return json_encode($result);
        }
    }

    //function to export data to xls
	public function exportToxls(){
        //echo "exportToxls";exit;
        $getdocuments = MlstEmployeeDocuments::select('id as Sr.No.','document_name as Document')->where(['deleted_status' => 0])->get();
        $getCount = $getdocuments->count();

        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Employee Document', function($excel) use($getdocuments){
				$excel->sheet('Documents', function($sheet) use($getdocuments){
					$sheet->fromArray($getdocuments);
				});
			})->export('xlsx');				
		}				
	}

}
