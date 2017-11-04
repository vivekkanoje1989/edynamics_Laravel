<?php
namespace App\Modules\ManageDepartment\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ManageDepartment\Models\MlstBmsbDepartment;
use DB;
use App\Classes\CommonFunctions;
use Auth;
use Excel;
use Illuminate\Support\Facades\Input;
use App\Modules\ManageDepartment\Models\MlstBmsbVerticals;

class ManageDepartmentController extends Controller {
  
    public function index() {
        return view("ManageDepartment::index")->with("loggedInUserId", Auth::guard('admin')->user()->id);
    }

    public function manageDepartment() {
        $getDepartments = MlstBmsbDepartment::with(['vertical'])->select('department_name','id','vertical_id')->where('deleted_status','=', 0)->get();
        $getCount = $getDepartments->count();
        // print_r($getDepartments, true);
       // $getDepartment = MlstBmsbDepartment::leftJoin('laravel_developement_master_edynamics.mlst_bmsb_verticals as mlst_bmsb_verticals', 'mlst_bmsb_departments.vertical_id', '=', 'mlst_bmsb_verticals.id')->select('mlst_bmsb_departments.id', 'name', 'department_name', 'vertical_id')->get();
        $i=0;
        foreach($getDepartments as $getDepartment){
            $getDepartments[$i]['verticalData'] = $getDepartment['vertical']['name'];
            $i++;
        }
        
        if (!empty($getDepartments)) {
            $result = ['success' => true, 'records' => $getDepartments, 'totalCount' => $getCount];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

    public function getDepartment() {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);
        $getDepartment = MlstBmsbDepartment::leftJoin('mlst_bmsb_verticals', 'mlst_bmsb_departments.vertical_id', '=', 'mlst_bmsb_verticals.id')->where('mlst_bmsb_departments.id', $request['id'])->select('mlst_bmsb_departments.id', 'name', 'department_name', 'vertical_id')->where('mlst_bmsb_departments.deleted_status','=', 0)->get();
        if (!empty($getDepartment)) {
            $result = ['success' => true, 'records' => $getDepartment];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response   
     */
    public function store() {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = MlstBmsbDepartment::where(['department_name' => $request['department_name']])->where(['vertical_id' => $request['vertical_id']])->where(['deleted_status' => 0])->get()->count();
        if ($cnt > 0) {
            $result = ['success' => false, 'errormsg' => 'Department already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['departmentData'] = array_merge($request, $create);
            $result = MlstBmsbDepartment::create($input['departmentData']);
            $last3 = MlstBmsbDepartment::latest('id')->first();
            $input['departmentData']['main_record_id'] = $last3->id;
            $vertical = MlstBmsbVerticals::select('name')->where('id','=',$request['vertical_id'])->first();
            $result = ['success' => true, 'result' => $result, 'lastinsertid' => $last3->id, 'verticalData' => $vertical['name'] ];
            return json_encode($result);
        }
    }

    public function update($id) {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);
    
        $getCount = MlstBmsbDepartment::where(['department_name' => $request['department_name'], ['id', '!=', $id]])->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Department already exists'];
            return json_encode($result);
        } else {
            $result = MlstBmsbDepartment::where('id', $id)->update($request);
            $vertical = MlstBmsbVerticals::where('id','=',$request['vertical_id'])->first();
            $result = ['success' => true, 'result' => $result,'vertical'=>$vertical];
            return json_encode($result);
        }
    }

    public function destroy($id) {
        $getCount = MlstBmsbDepartment::where('id', '=', $id)->get()->count();
        if ($getCount < 0) {
            $result = ['success' => false, 'errormsg' => 'Department can not be deleted'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['departmentData'] = $delete;
            $result = MlstBmsbDepartment::where('id', $id)->update($input['departmentData']);
            $result = ['success' => true, 'result' => $result];
            return json_encode($result);
        }
    }

    //function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit;
		$getDepartments = MlstBmsbDepartment::select('id','department_name','vertical_id')->where('deleted_status','=', 0)->get();
        $getCount = $getDepartments->count();

        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Export Data', function($excel) use($getDepartments){
				$excel->sheet('Verticals', function($sheet) use($getDepartments){
					$sheet->fromArray($getDepartments);
				});
			})->export('xlsx');				
		}				
	}

}
