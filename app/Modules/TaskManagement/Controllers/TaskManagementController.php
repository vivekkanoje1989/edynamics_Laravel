<?php namespace App\Modules\TaskManagement\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Modules\ProductManagement\Models\ProductManagement;
use App\Modules\ProductManagement\Models\SubProduct;
use App\Modules\ProductManagement\Models\Pmodule;
use App\Modules\ProductManagement\Models\Submodule;
use App\Modules\TaskManagement\Models\TmStatus;
use App\Modules\TaskManagement\Models\TmPriority;
use App\Modules\TaskManagement\Models\TaskManagement;
use App\Modules\Designations\Models\MlstBmsbDesignations;
use App\Models\backend\Employee;
use App\Classes\CommonFunctions;
use Auth;
use DB;
use App\Classes\S3;
use Excel;


class TaskManagementController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("TaskManagement::index");
	}


	public function mytasklist()
	{
		return view("TaskManagement::mytask");
	}	

	public function addtask()
	{	
		return view("TaskManagement::addtask")->with('empId', Auth::guard('admin')->user()->id);
	}
	
	
	public function getSupportEmp()
	{		
		$designationSpprt = MlstBmsbDesignations::select('id','designation','status')->where(['designation' => 'Support', 'deleted_status' => 0, 'status' => 1,])->get()->toArray();
		$getCount =MlstBmsbDesignations::select('id','designation','status')->where(['designation' => 'Support', 'deleted_status' => 0, 'status' => 1,])->get()->count();
		
		if($getCount > 0){
			$designationID = $designationSpprt[0]['id'];			
		}else{
			$designationID = 0;
		}

		if($designationID != 0){
			$supportlist = Employee::select('id', 'employee_id', 'first_name', 'last_name', 'designation_id', 'department_id')->where(['designation_id' => $designationID, 'deleted_status' => 0, 'employee_status' => 1,])->get()->toArray();			
			
			// $newlist = [];
			// $newlistFnl = [];
			foreach($supportlist as $key => $dl){
				$supportlist[$key]['dispay_name'] = $dl['first_name'] .' '. $dl['last_name'];
				// $fnm = '';
				// $lnm = '';
				// $dspnm = '';
				// foreach($dl as $key => $value){					
				// 	$newlist[$key] = $value;
				// 	if($key =='first_name'){
				// 		$fnm = $value;
				// 	}else{}
					
				// 	if($key =='last_name'){
				// 		$lnm = $value;
				// 	}else{}
					
				// 	$dspnm = "$fnm $lnm";
				// 	$newlist['dispay_name'] = $dspnm;
				// }
				// array_push($newlistFnl, $newlist);
			}
			$result = ['success' => true, 'records' => $supportlist];
			return json_encode($result);
		}else {
			$result = ['success' => false, 'message' => 'Module Not Found.'];
			return json_encode($result);
		}
		
	}


	public function getTmStatus()
	{
		$status = TmStatus::select('id','status_name')->where(['deleted_status' => 0])->get()->toArray();
		$getCount = TmStatus::where(['deleted_status' => 0])->get()->count();
		
		if($getCount > 0){			
			$result = ['success' => true, 'records' => $status];
			return json_encode($result);
		}else {
			$result = ['success' => false, 'message' => 'Record Not Found.'];
			return json_encode($result);
		}
	}

	public function getTmPriority()
	{
		$priority = TmPriority::select('id','priority_name')->where(['deleted_status' => 0])->get()->toArray();
		$getCount = TmPriority::where(['deleted_status' => 0])->get()->count();
		
		if($getCount > 0){			
			$result = ['success' => true, 'records' => $priority];
			return json_encode($result);
		}else {
			$result = ['success' => false, 'message' => 'Record Not Found.'];
			return json_encode($result);
		}
	}	

	public function getTasklist()
	{	
		$tasks = TaskManagement::select('tm_task_list.*','sbm.sub_module_name', 'prio.priority_name')->leftjoin('laravel_developement_master_edynamics.mlst_tm_priority as prio','prio.id','=','laravel_developement_edynamics.tm_task_list.task_priority')->leftjoin('laravel_developement_master_edynamics.mlst_sub_modules as sbm','sbm.id','=','laravel_developement_edynamics.tm_task_list.sub_modules_id')->where(['tm_task_list.deleted_status' => 0])->get();
		$getCount = $tasks->count();
		
		if($getCount > 0){			
			$result = ['success' => true, 'records' => $tasks, 'totalCount' => $getCount];
			return json_encode($result);
		}else {
			$result = ['success' => false, 'message' => 'Record Not Found.'];
			return json_encode($result);
		}
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	public function createTask()
	{
		
		$input = Input::all();
		if ($input) {

			if ($input['screenshot']) {

				$originalName = ($input['screenshot'])->getClientOriginalName();
				$originalNameExt = ($input['screenshot'])->getClientOriginalExtension();
			
				if ($originalName != "fileNotSelected") {
					if (!empty($input['screenshot'])) {

						$folderName = 'task_management';
						$image =  $input['screenshot']->getPathName();

						$imageName = time() . "." .$originalNameExt ;
						$tempPath = ($input['screenshot'])->getPathName();
						$name = S3::s3FileUpload($tempPath, $imageName, $folderName);

						$image = ['0' => $input['screenshot']];
						$imageName = S3::s3FileUplod($image, $folderName, 1);
						$imageName = trim($imageName, ',');
						$input['createTaskdetails']['task_screenshots'] = $imageName;						

						unset($input['createTaskdetails']['employee_photo_file_name']);
						unset($input['screenshot']);
					
					}else{}
				} else {
					unset($input['createTaskdetails']['employee_photo_file_name']);
					unset($input['screenshot']);
				}
			}else{}		

			$requestData = [];

			foreach($input as $key => $value){
				if($key == 'createTask'){
					foreach($value as $k1 => $v1){
						$requestData[$k1] = $v1;
					}
				}else if($key == 'createAssignto'){
					foreach($value as $k2 => $v2){
						$requestData[$k2] = $v2;					
					}
				}else if($key == 'createTaskdetails'){
					foreach($value as $k3 => $v3){
						$requestData[$k3] = $v3;					
					}
				}else if($key == 'createStatus'){
					foreach($value as $k4 => $v4){
						$requestData[$k4] = $v4;					
					}
				}else{}

			}

			$loggedInUserId = Auth::guard('admin')->user()->id;
			$requestData['assign_by'] = $loggedInUserId;			
			
			$create = CommonFunctions::insertMainTableRecords($loggedInUserId);
			$requestData = array_merge($requestData, $create);
			
			$createtask = TaskManagement::create($requestData);
			
			$result = ['success' => true, 'message' => 'Task created successfully'];
			return json_encode($result);
		}else{
			$result = ['success' => false, 'message' => 'Task created can not be created.'];
			return json_encode($result);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * Approve task
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{		
		if($id != 0 ){
			$postdata = file_get_contents('php://input');
			$request = json_decode($postdata, true);
			$request['completion_date'] = date("Y-m-d");
			$request['task_status'] = 'close';
					

			$loggedInUserId = Auth::guard('admin')->user()->id;
			$update = CommonFunctions::updateMainTableRecords($loggedInUserId);
			$input['approvetaskData'] = array_merge($request, $update);
			$result = TaskManagement::where('id', $id)->update($input['approvetaskData']);	
			
			$records  = TaskManagement::select('tm_task_list.*','sbm.sub_module_name', 'prio.priority_name')->leftjoin('laravel_developement_master_edynamics.mlst_tm_priority as prio','prio.id','=','laravel_developement_edynamics.tm_task_list.task_priority')->leftjoin('laravel_developement_master_edynamics.mlst_sub_modules as sbm','sbm.id','=','laravel_developement_edynamics.tm_task_list.sub_modules_id')->where(['tm_task_list.deleted_status' => 0])->get();

			$result = ['success' => true, 'records' => $records, 'totalCount' => count($records)];
			return json_encode($result);
		}else{
			$result = ['success' => false];
			return json_encode($result);
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function exportToxls(){
		$record  = TaskManagement::select('tm_task_list.*','sbm.sub_module_name', 'prio.priority_name')->leftjoin('laravel_developement_master_edynamics.mlst_tm_priority as prio','prio.id','=','laravel_developement_edynamics.tm_task_list.task_priority')->leftjoin('laravel_developement_master_edynamics.mlst_sub_modules as sbm','sbm.id','=','laravel_developement_edynamics.tm_task_list.sub_modules_id')->where(['tm_task_list.deleted_status' => 0])->get();
		//export to excel
		Excel::create('Task List Info', function($excel) use($record){
			$excel->sheet('Tasks', function($sheet) use($record){
				$sheet->fromArray($record);
			});
		})->export('xlsx');	
	}

}
