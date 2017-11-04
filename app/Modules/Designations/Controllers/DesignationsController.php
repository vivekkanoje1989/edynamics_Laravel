<?php

namespace App\Modules\Designations\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Designations\Models\MlstBmsbDesignations;
use Illuminate\Http\Request;
use Auth;
use Excel;
use App\Classes\CommonFunctions;

class DesignationsController extends Controller {

    public function index() {
        return view("Designations::index");
    }

    public function manageDesignations() {
        $getDesignations = MlstBmsbDesignations::select('designation','status','id')->where(['deleted_status' => 0])->get();
        $totalcount = $getDesignations->count();
      

        if (!empty($getDesignations)) {
            $result = ['success' => true, 'records' => $getDesignations, 'totalcount' => $totalcount ];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

    public function store() {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = MlstBmsbDesignations::where(['designation' => $request['designation']])->where(['deleted_status' => 0])->get()->count();
        if ($cnt > 0) {
            $result = ['success' => false, 'errormsg' => 'Designation already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['designationsData'] = array_merge($request, $create);
            $result = MlstBmsbDesignations::create($input['designationsData']);
            $last3 = MlstBmsbDesignations::latest('id')->first();
            $result = ['success' => true, 'result' => $result, 'lastinsertid' => $last3->id];
            return json_encode($result);
        }
    }

    public function update($id) {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $getCount = MlstBmsbDesignations::where(['designation' => $request['designation']])->where('id','!=',$id)->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Designation already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['designationData'] = array_merge($request, $update);
            $originalValues = MlstBmsbDesignations::where('id',$id)->get();
            $result = MlstBmsbDesignations::where('id', $id)->update($input['designationData']);
            $result = ['success' => true, 'result' => $result];
            return json_encode($result);
        }
    }

    public function destroy($id) {
        $getCount = MlstBmsbDesignations::where('id','=',$id)->get()->count();
        if ($getCount < 1) {
            $result = ['success' => false, 'errormsg' => 'Designation already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['designationData'] = $delete;
            $result = MlstBmsbDesignations::where('id', $id)->update($input['designationData']);
            $result = ['success' => true, 'result' => $result];
            return json_encode($result);
        }
    }

    //function to export data to xls
	public function exportToxls(){
        //echo "exportToxls";exit;
        $getDesignations = MlstBmsbDesignations::select('id','designation','status')->where(['deleted_status' => 0])->get();
        $getCount = $getDesignations->count();

        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Export Data', function($excel) use($getDesignations){
				$excel->sheet('Verticals', function($sheet) use($getDesignations){
					$sheet->fromArray($getDesignations);
				});
			})->export('xlsx');				
		}				
	}

}
