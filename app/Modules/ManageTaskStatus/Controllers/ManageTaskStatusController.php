<?php namespace App\Modules\ManageTaskStatus\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Modules\ManageTaskStatus\Models\ManageTaskStatus;
use App\Classes\CommonFunctions;
use Auth;
use DB;
use Excel;

class ManageTaskStatusController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("ManageTaskStatus::index");
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

	public function getStatus()
	{		
		$tskstatus = ManageTaskStatus::where(['deleted_status' => 0])->get();
		$count = $tskstatus->count();
		if($count > 0){
			$result = ['success' => true, 'records' => $tskstatus, 'totalCount' => count($tskstatus)];
            return json_encode($result);
		}else{
			$result = ['success' => false, 'messsage' => 'No Record found.'];
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
		$postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = ManageTaskStatus::where(['status_name' => $request['status_name']])->where('deleted_status', '=', 0 )->get()->count();
        if ($cnt > 0) {  //exists priority Name
            $result = ['success' => false, 'errormsg' => 'Status already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['statusData'] = array_merge($request, $create);
            $tskstatus = ManageTaskStatus::create($input['statusData']);
            $last3 = ManageTaskStatus::latest('id')->first();
            $tskstatus = ManageTaskStatus::where(['deleted_status' => 0])->get();
            // $result = ['success' => true, 'result' => $bloodgroup, 'lastinsertid' => $last3->id];
            $result = ['success' => true, 'records' => $tskstatus, 'totalCount' => count($tskstatus)];
            return json_encode($result);
        }
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $getCount = ManageTaskStatus::where(['status_name' => $request['status_name']])->where('id', '!=', $id)->where('deleted_status', '=', 0 )->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Status already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['statusData'] = array_merge($request, $update);
            $result = ManageTaskStatus::where('id', $id)->update($input['statusData']);

            // $result = ['success' => true, 'result' => $result];

            $tskstatus = ManageTaskStatus::where(['deleted_status' => 0])->get();
            $result = ['success' => true, 'records' => $tskstatus, 'totalCount' => count($tskstatus)];
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
		$getCount = ManageTaskStatus::where('id', '=', $id)->get()->count();
        if ($getCount < 1) {
            $result = ['success' => false, 'errormsg' => 'Status does not exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['statusData'] = $delete;

            $result = ManageTaskStatus::where('id', $id)->update($input['statusData']);            
            
            $tskstatus = ManageTaskStatus::where(['deleted_status' => 0])->get();
            $result = ['success' => true, 'records' => $tskstatus, 'totalCount' => count($tskstatus)];
            return json_encode($result);
        }
	}

	 //function to export data to xls
	 public function exportToxls(){
		//echo "exportToxls";exit;		
		$tskstatus = ManageTaskStatus::select('id as Sr.No.', 'status_name')->where('deleted_status', '=', 0)->get(); 		
		$getCount = $tskstatus->count(); 

        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Status Data', function($excel) use($tskstatus){
				$excel->sheet('Status', function($sheet) use($tskstatus){
					$sheet->fromArray($tskstatus);
				});
			})->export('xlsx');				
		}				
	}

}
