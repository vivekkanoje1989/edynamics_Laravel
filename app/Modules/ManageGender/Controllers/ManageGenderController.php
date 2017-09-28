<?php namespace App\Modules\ManageGender\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\ManageGender\Models\Mlstgender;
use App\Classes\CommonFunctions;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Auth;
use DB;
use Excel;

class ManageGenderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("ManageGender::index")->with("loggedInUserId", Auth::guard('admin')->user()->id);
	}

	/**
	 * Get all records.
	 *
	 * @return Response
	 */
	public function getGender() {
        $getGender = Mlstgender::select('id', 'gender', 'status')->where('deleted_status', '=', 0)->get();
		$getGenderCount = $getGender->count();
        if (!empty($getGender)) {
            $result = ['success' => true, 'records' => $getGender, 'totalCount' => $getGenderCount ] ;
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

        $cnt = Mlstgender::where(['gender' => $request['gender']])->where('deleted_status', '=', 0)->get()->count();
		
		if ($cnt > 0) {
			$result = ['success' => false, 'errormsg' => 'Gender already exists'];			
            return json_encode($result);
        } else {
			$loggedInUserId = Auth::guard('admin')->user()->id;			
			$create = CommonFunctions::insertMainTableRecords($loggedInUserId);			
			$input['genderData'] = array_merge($request, $create);
			$result = Mlstgender::create($input['genderData']);			
			$getGender = Mlstgender::select('id', 'gender', 'status')->where('deleted_status', '=', 0)->get();
			$getGenderCount = $getGender->count();
			$last_insertedId = Mlstgender::latest('id')->first();
            $result = ['success' => true, 'result' => $result, 'records' => $getGender,'last_insertedId' => $last_insertedId, 'totalCount' => $getGenderCount ];
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
		$id = (Int)$id;
		$postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);
        $getCount = Mlstgender::where('id', '!=', $id)->where(['gender' => $request['gender']])->where('deleted_status', '=', 0)->get()->count();
		
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Gender already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['genderData'] = array_merge($request, $create);
            $result = Mlstgender::where('id', $request['id'])->update($input['genderData']);		
			
			$getGender = Mlstgender::select('id', 'gender', 'status')->where('deleted_status', '=', 0)->get();
			$getGenderCount = $getGender->count();
			$last_updatedId = $request['id'];
            $result = ['success' => true, 'result' => $result, 'records' => $getGender,'last_updatedId' => $last_updatedId, 'totalCount' => $getGenderCount ];
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
        $getCount = Mlstgender::where('id', '=', $id)->get()->count();        
        if ($getCount < 1) {
             $result = ['success' => false, 'errormsg' => 'Gender does not exists'];
             return json_encode($result);
        } else {
             $loggedInUserId = Auth::guard('admin')->user()->id;
             $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
             $input['genderData'] = $delete; 
             $result = Mlstgender::where('id', $id)->update($input['genderData']);
			 $getGender = Mlstgender::select('id', 'gender', 'status')->where('deleted_status', '=', 0)->get();
			 $getGenderCount = $getGender->count();
			 $result = ['success' => true, 'result' => $result, 'records' => $getGender, 'totalCount' => $getGenderCount ];
			 return json_encode($result);
        }
	}

	//function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit; 
		$getGender = Mlstgender::select('id as Sr.No.', 'gender as Gender', 'status')->where('deleted_status', '=', 0)->get();
		$getGenderCount = $getGender->count();
        if ($getGenderCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Genders', function($excel) use($getGender){
				$excel->sheet('Gender', function($sheet) use($getGender){
					$sheet->fromArray($getGender);
				});
			})->export('xlsx');				
		}				
	}

}
