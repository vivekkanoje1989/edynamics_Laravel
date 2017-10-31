<?php namespace App\Modules\ManageTaskPriority\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ManageTaskPriority\Models\ManageTaskPriority;
use App\Classes\CommonFunctions;
use Auth;
use DB;
use Excel;

class ManageTaskPriorityController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("ManageTaskPriority::index");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		echo "create";
	}

	public function getPriority()
	{		
		$tskpriority = ManageTaskPriority::where(['deleted_status' => 0])->get();
		$count = $tskpriority->count();
		if($count > 0){
			$result = ['success' => true, 'records' => $tskpriority, 'totalCount' => count($tskpriority)];
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

        $cnt = ManageTaskPriority::where(['priority_name' => $request['priority_name']])->where('deleted_status', '=', 0 )->get()->count();
        if ($cnt > 0) {  //exists priority Name
            $result = ['success' => false, 'errormsg' => 'Priority already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['priorityData'] = array_merge($request, $create);
            $tskpriority = ManageTaskPriority::create($input['priorityData']);
            $last3 = ManageTaskPriority::latest('id')->first();
            $tskpriority = ManageTaskPriority::where(['deleted_status' => 0])->get();
            // $result = ['success' => true, 'result' => $bloodgroup, 'lastinsertid' => $last3->id];
            $result = ['success' => true, 'records' => $tskpriority, 'totalCount' => count($tskpriority)];
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

        $getCount = ManageTaskPriority::where(['priority_name' => $request['priority_name']])->where('id', '!=', $id)->where('deleted_status', '=', 0 )->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Priority already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['tskpriorityData'] = array_merge($request, $update);
            $result = ManageTaskPriority::where('id', $id)->update($input['tskpriorityData']);

            // $result = ['success' => true, 'result' => $result];

            $tskpriority = ManageTaskPriority::where(['deleted_status' => 0])->get();
            $result = ['success' => true, 'records' => $tskpriority, 'totalCount' => count($tskpriority)];
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
		$getCount = ManageTaskPriority::where('id', '=', $id)->get()->count();
        if ($getCount < 1) {
            $result = ['success' => false, 'errormsg' => 'Priority does not exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['tskpriorityData'] = $delete;

            $result = ManageTaskPriority::where('id', $id)->update($input['tskpriorityData']);            
            
            $tskpriority = ManageTaskPriority::where(['deleted_status' => 0])->get();
            $result = ['success' => true, 'records' => $tskpriority, 'totalCount' => count($tskpriority)];
            return json_encode($result);
        }
	}

	 //function to export data to xls
	 public function exportToxls(){
		//echo "exportToxls";exit;		
		$tskpriority = ManageTaskPriority::select('id as Sr.No.', 'priority_name')->where('deleted_status', '=', 0)->get(); 		
		$getCount = $tskpriority->count(); 

        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Task Priority Data', function($excel) use($tskpriority){
				$excel->sheet('Priority', function($sheet) use($tskpriority){
					$sheet->fromArray($tskpriority);
				});
			})->export('xlsx');				
		}				
	}

}
