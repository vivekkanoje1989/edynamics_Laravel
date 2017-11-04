<?php

namespace App\Modules\ManageLostReason\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Classes\CommonFunctions;
use App\Modules\ManageLostReason\Models\MlstBmsbEnquiryLostReasons;
use Auth;
use Excel;

class ManageLostReasonController extends Controller {

    public function index() {
        return view("ManageLostReason::index");
    }

    public function manageLostReason() {
        $data = MlstBmsbEnquiryLostReasons::select('id', 'reason', 'lost_reason_status')->where('deleted_status', '=', 0)->get();
        $getCount = $data->count();
        if ($data) {
            $result = ['success' => true, 'records' => $data, 'totalCount' => $getCount];
            echo json_encode($result);
        } else {
            $result = ['success' => false, 'records' => 'Something Wents Wrong'];
            echo json_encode($result);
        }
    }

    public function store() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);

        $cnt = MlstBmsbEnquiryLostReasons::where(['reason' => $request['reason']])->where('deleted_status', '=', 0)->get()->count();
        if ($cnt > 0) {
            $result = ['warning' => false, 'errormsg' => 'Lost reason already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['reasonData'] = array_merge($request, $create);
            $result = MlstBmsbEnquiryLostReasons::create($input['reasonData']);
            $last3 = MlstBmsbEnquiryLostReasons::latest('id')->first();
            $getCount = MlstBmsbEnquiryLostReasons::select('id', 'reason', 'lost_reason_status')->where('deleted_status', '=', 0)->get()->count();            
            $result = ['success' => true, 'result' => $result, 'lastinsertid' => $last3->id, 'totalCount' => $getCount];
            return json_encode($result);
        }
    }

    public function update($id) {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
       
        $getCount = MlstBmsbEnquiryLostReasons::where('id','!=', $id)->where(['reason' => $request['reason']])->get()->count();
        
        if ($getCount > 0 ) {
            $result = ['success' => false, 'errormsg' => 'Reason already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['lostReason'] = array_merge($request, $update);
            $result = MlstBmsbEnquiryLostReasons::where('id', $request['id'])->update($input['lostReason']);
            $getCount = MlstBmsbEnquiryLostReasons::select('id', 'reason', 'lost_reason_status')->where('deleted_status', '=', 0)->get()->count();            
            $result = ['success' => true, 'result' => $result, 'totalCount' => $getCount];
            return json_encode($result);
        }
    }

    public function destroy($id) {

        $getCount = MlstBmsbEnquiryLostReasons::where('id', $id)->get()->count();
        if ($getCount < 1) {
            $result = ['success' => false, 'errormsg' => 'Reason can not be deleted'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['lostReason'] = $delete;
            $result = MlstBmsbEnquiryLostReasons::where('id', $id)->update($input['lostReason']);
            $records = MlstBmsbEnquiryLostReasons::select('id', 'reason', 'lost_reason_status')->where('deleted_status', '=', 0)->get();
            $getCount = $records->count();   
            $result = ['success' => true, 'result' => $result, 'records' => $records, 'totalCount' => $getCount];
            return json_encode($result);
        }
    }

    //function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit;		
        $records = MlstBmsbEnquiryLostReasons::select('id as Sr.No.', 'reason as Reason', 'lost_reason_status as Status')->where('deleted_status', '=', 0)->get();
		$getCount = $records->count(); 
        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Export Data', function($excel) use($records){
				$excel->sheet('Verticals', function($sheet) use($records){
					$sheet->fromArray($records);
				});
			})->export('xlsx');				
		}				
	}

}
