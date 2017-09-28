<?php

namespace App\Modules\HighestEducation\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\HighestEducation\Models\MlstEducations;
use App\Classes\CommonFunctions;
use DB;
use Auth;
use Excel;
class HighestEducationController extends Controller {

    public function index() {
        return view("HighestEducation::index");
    }
    public function manageHighestEducation() {
        $getHighestEducations = MlstEducations::select('education','status','id')->where('deleted_status','=', 0)->get();
        $getCount = $getHighestEducations->count();
//         $i = 0;
//        foreach($getHighestEducations as $getHighestEducation){
//            if($getHighestEducation['status'] == 1){
//            $getHighestEducations[$i]['status'] = 'active';
//            }else{
//            $getHighestEducations[$i]['status'] = 'inactive';
//            }
//            $i++;
//        }
        if (!empty($getHighestEducations)) {
            $result = ['success' => true, 'records' => $getHighestEducations , 'totalCount' => $getCount];
            return json_encode($result);
        }else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }
    public function store() {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);
       
        $cnt = MlstEducations::where('education','=', $request['education'])->where('deleted_status','!=', 1)->get()->count();
        
        if ($cnt > 0) {
            $result = ['success' => false, 'errormsg' => 'Education title already exists'];
            return json_encode($result);
        } else {
             $loggedInUserId = Auth::guard('admin')->user()->id; 
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['educationData'] = array_merge($request, $create);
            $result = MlstEducations::create($input['educationData']);
            $last3 = MlstEducations::latest('id')->first();
            $input['educationData']['main_record_id'] = $last3->id;

            $result = ['success' => true, 'result' => $result, 'lastinsertid' => $last3->id];
            return json_encode($result);
        }
    }
    
    public function update($id) {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);
       
        $getCount = MlstEducations::where(['education' => $request['education']])->where('id','!=',$id)->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Education title already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['educationData'] = array_merge($request, $update);
            $records = MlstEducations::where('deleted_status','!=',1)->get();
            $result = MlstEducations::where('id', $id)->update($input['educationData']);
            $result = ['success' => true, 'result' => $result, 'record' => $records];
            return json_encode($result);
        }
    }

    public function destroy($id) {
        $getCount = MlstEducations::where('id','=',$id)->get()->count();
        if ($getCount < 1) {
            $result = ['success' => false, 'errormsg' => 'Education title already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['educationData'] = $delete;
            $result = MlstEducations::where('id', $id)->update($input['educationData']);
            $records = MlstEducations::where('deleted_status','!=',1)->get();
            $result = ['success' => true, 'result' => $result, 'record' => $records];
            return json_encode($result);
        }

    }

    //function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit;
		$getHighestEducations = MlstEducations::select('id','education','status')->where('deleted_status','=', 0)->get();
        $getCount = $getHighestEducations->count();

        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Export Data', function($excel) use($getHighestEducations){
				$excel->sheet('Verticals', function($sheet) use($getHighestEducations){
					$sheet->fromArray($getHighestEducations);
				});
			})->export('xlsx');				
		}				
	}
}
