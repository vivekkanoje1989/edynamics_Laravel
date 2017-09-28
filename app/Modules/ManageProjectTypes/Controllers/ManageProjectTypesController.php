<?php

namespace App\Modules\ManageProjectTypes\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ManageProjectTypes\Models\MlstBmsbProjectTypes;
use DB;
use App\Classes\CommonFunctions;
use Auth;
use Excel;

class ManageProjectTypesController extends Controller {

    public function index() {
        return view("ManageProjectTypes::index");
    }

    public function manageProjectTypes() {
        $getTypes = MlstBmsbProjectTypes::select('project_type','id')->where('deleted_status', 0)->get();
        $getCount = $getTypes->count();

        if (!empty($getTypes)) {
            $result = ['success' => true, 'records' => $getTypes, 'totalCount' => $getCount ];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

    public function store() {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = MlstBmsbProjectTypes::where(['project_type' => $request['project_type']])->where('deleted_status', 0)->get()->count();
        if ($cnt > 0) {
            $result = ['success' => false, 'errormsg' => 'Project type already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['projectTypeData'] = array_merge($request, $create);
            $result = MlstBmsbProjectTypes::create($input['projectTypeData']);
            $last3 = MlstBmsbProjectTypes::latest('id')->first();
            $input['projectTypeData']['id'] = $last3->id;
            $getProjectTypes = MlstBmsbProjectTypes::select('project_type','id')->where('deleted_status', 0)->get();
            $getCount = $getProjectTypes->count();
            $result = ['success' => true, 'result' => $result, 'lastinsertid' => $last3->id, 'totalCount' => $getCount];
            return json_encode($result);
        }
    }

    public function update($id) {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $getCount = MlstBmsbProjectTypes::where(['project_type' => $request['project_type']])->where('id', '!=', $id)->where('deleted_status', 0)->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Project type already exists'];
            return json_encode($result);
        } else {
            $result = MlstBmsbProjectTypes::where('id', $request['id'])->update($request);
            $getProjectTypes = MlstBmsbProjectTypes::select('project_type','id')->where('deleted_status', 0)->get();
            $getCount = $getProjectTypes->count();
            $result = ['success' => true, 'result' => $result, 'totalCount' => $getCount];
            return json_encode($result);
        }
    }

    //delete
    public function destroy($id) {

        $getCount = MlstBmsbProjectTypes::where('id', $id)->get()->count();
        if ($getCount < 1) {
            $result = ['success' => false, 'errormsg' => 'Project type can not be deleted'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['projecttypeData'] = $delete;
            $result = MlstBmsbProjectTypes::where('id', $id)->update($input['projecttypeData']);
            $records = MlstBmsbProjectTypes::select('project_type','id')->where('deleted_status', 0)->get();
            $getCount = $records->count();
            $result = ['success' => true, 'result' => $result, 'records' => $records, 'totalCount' => $getCount];
            return json_encode($result);
        }
    }

    //function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit;
		 
		$getProjectTypes = MlstBmsbProjectTypes::select('id as Sr.No.','project_type as ProjectType')->where('deleted_status', 0)->get();
        $getCount = $getProjectTypes->count();

        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Project Types', function($excel) use($getProjectTypes){
				$excel->sheet('Types', function($sheet) use($getProjectTypes){
					$sheet->fromArray($getProjectTypes);
				});
			})->export('xlsx');				
		}				
	}

}
