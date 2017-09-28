<?php namespace App\Modules\ManageClientRole\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\ManageClientRole\Models\mlstclientroles;
use Illuminate\Http\Request;
use App\Classes\CommonFunctions;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Excel;

class ManageClientRoleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("ManageClientRole::index")->with("loggedInUserId", Auth::guard('admin')->user()->id);
	}

	
	/**
	 * Returns response of all records.
	 *
	 * @return Response
	 */
	public function getClientRole()
	{
		$getClntRl = mlstclientroles::select('id', 'role_name', 'status')->where('deleted_status', '=', 0)->get();
		$getClntRlCount = $getClntRl->count();
        if ($getClntRlCount > 0) {
            $result = ['success' => true, 'records' => $getClntRl, 'totalCount' => $getClntRlCount ] ;
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{		
		$postdata = file_get_contents('php://input');
		$request = json_decode($postdata, true);

        $cnt = mlstclientroles::where(['role_name' => $request['role_name']])->where('deleted_status', '=', 0)->get()->count();
		
		if ($cnt > 0) {
			$result = ['success' => false, 'errormsg' => 'Client Role already exists'];			
            return json_encode($result);
        } else {
			$loggedInUserId = Auth::guard('admin')->user()->id;			
			$create = CommonFunctions::insertMainTableRecords($loggedInUserId);			
			$input['clntrlData'] = array_merge($request, $create);
			$result = mlstclientroles::create($input['clntrlData']);			
			$getClntRl = mlstclientroles::select('id', 'role_name', 'status')->where('deleted_status', '=', 0)->get();
			$getClntRlCount = $getClntRl->count();
			$last_insertedId = mlstclientroles::latest('id')->first();
            $result = ['success' => true, 'result' => $result, 'records' => $getClntRl,'last_insertedId' => $last_insertedId, 'totalCount' => $getClntRlCount ];
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
		// echo "update";exit;
		$postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);
        $getCount = mlstclientroles::where('id', '!=', $id)->where(['role_name' => $request['role_name']])->where('deleted_status', '=', 0)->get()->count();
		
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Client Role already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['clntrlData'] = array_merge($request, $create);
            $result = mlstclientroles::where('id', $request['id'])->update($input['clntrlData']);		
			
			$getClntRl = mlstclientroles::select('id', 'role_name', 'status')->where('deleted_status', '=', 0)->get();
			$getClntRlCount = $getClntRl->count();
			$last_updatedId = $request['id'];
            $result = ['success' => true, 'result' => $result, 'records' => $getClntRl,'last_updatedId' => $last_updatedId, 'totalCount' => $getClntRlCount ];
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
		// echo "destroy";exit;
		$id = (Int)$id;      
        $getCount = mlstclientroles::where('id', '=', $id)->get()->count();        
        if ($getCount < 1) {
             $result = ['success' => false, 'errormsg' => 'Client Role does not exists'];
             return json_encode($result);
        } else {
             $loggedInUserId = Auth::guard('admin')->user()->id;
             $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
             $input['clntrlData'] = $delete; 
             $result = mlstclientroles::where('id', $id)->update($input['clntrlData']);
			 $getClntRl = mlstclientroles::select('id', 'role_name', 'status')->where('deleted_status', '=', 0)->get();
			 $getClntRlCount = $getClntRl->count();
			 $result = ['success' => true, 'result' => $result, 'records' => $getClntRl, 'totalCount' => $getClntRlCount ];
			 return json_encode($result);
        }
	}

	//function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit; 
		$getClntRl = mlstclientroles::select('id as Sr.No.', 'role_name as ClientRole', 'status')->where('deleted_status', '=', 0)->get(); 		
		$getClntRlCount = $getClntRl->count();
        if ($getClntRlCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Client Roles', function($excel) use($getClntRl){
				$excel->sheet('Roles', function($sheet) use($getClntRl){
					$sheet->fromArray($getClntRl);
				});
			})->export('xlsx');				
		}				
	}

}