<?php namespace App\Modules\ManageCompanyTypes\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ManageCompanyTypes\Models\MlstCompanyTypes;
use App\Classes\CommonFunctions;
use DB;
use Auth;
use Excel;

class ManageCompanyTypesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("ManageCompanyTypes::index")->with("loggedInUserId", Auth::guard('admin')->user()->id);
	}

	/**
	 * Get all records.
	 *
	 * @return Response
	 */
	 public function getCompanyTypes() {
		//  echo "getCompanyTypes";exit;
        $getCompanyType = MlstCompanyTypes::select('id', 'type_of_company', 'status')->where('deleted_status', '=', 0)->get();
		$getCompanyTypeCount = $getCompanyType->count();
        if (!empty($getCompanyType)) {
            $result = ['success' => true, 'records' => $getCompanyType, 'totalCount' => $getCompanyTypeCount ] ;
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

        $cnt = MlstCompanyTypes::where(['type_of_company' => $request['type_of_company']])->where('deleted_status', '=', 0)->get()->count();
		
		if ($cnt > 0) {
			$result = ['success' => false, 'errormsg' => 'Company Type already exists'];			
            return json_encode($result);
        } else {
			$loggedInUserId = Auth::guard('admin')->user()->id;			
			$create = CommonFunctions::insertMainTableRecords($loggedInUserId);			
			$input['companyTypeData'] = array_merge($request, $create);
			$result = MlstCompanyTypes::create($input['companyTypeData']);			
			$getCompanyType = MlstCompanyTypes::select('id', 'type_of_company', 'status')->where('deleted_status', '=', 0)->get();
			$getCompanyTypeCount = $getCompanyType->count();
			$last_insertedId = MlstCompanyTypes::latest('id')->first();
            $result = ['success' => true, 'result' => $result, 'records' => $getCompanyType,'last_insertedId' => $last_insertedId, 'totalCount' => $getCompanyTypeCount ];
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
        $getCount = MlstCompanyTypes::where('id', '!=', $id)->where(['type_of_company' => $request['type_of_company']])->where('deleted_status', '=', 0)->get()->count();
		
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Company type already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['companyTypeData'] = array_merge($request, $create);
            $result = MlstCompanyTypes::where('id', $request['id'])->update($input['companyTypeData']);		
			
			$getCompanyType = MlstCompanyTypes::select('id', 'type_of_company', 'status')->where('deleted_status', '=', 0)->get();
			$getCompanyTypeCount = $getCompanyType->count();
			$last_updatedId = $request['id'];
            $result = ['success' => true, 'result' => $result, 'records' => $getCompanyType,'last_updatedId' => $last_updatedId, 'totalCount' => $getCompanyTypeCount ];
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
        $getCount = MlstCompanyTypes::where('id', '=', $id)->get()->count();        
        if ($getCount < 1) {
             $result = ['success' => false, 'errormsg' => 'Company type does not exist'];
             return json_encode($result);
        } else {
             $loggedInUserId = Auth::guard('admin')->user()->id;
             $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
             $input['companyTypeData'] = $delete; 
             $result = MlstCompanyTypes::where('id', $id)->update($input['companyTypeData']);
			 $getCompanyType = MlstCompanyTypes::select('id', 'type_of_company', 'status')->where('deleted_status', '=', 0)->get();
			 $getCompanyTypeCount = $getCompanyType->count();
			 $result = ['success' => true, 'result' => $result, 'records' => $getCompanyType, 'totalCount' => $getCompanyTypeCount ];
			 return json_encode($result);
        }
	}

	//function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit; 
		$getCompanyType = MlstCompanyTypes::select('id as Sr.No.', 'type_of_company as TypeOfCompany', 'status')->where('deleted_status', '=', 0)->get();
		$getCompanyTypeCount = $getCompanyType->count();
        if ($getCompanyTypeCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Type Of Company', function($excel) use($getCompanyType){
				$excel->sheet('Company Types', function($sheet) use($getCompanyType){
					$sheet->fromArray($getCompanyType);
				});
			})->export('xlsx');				
		}				
	}

}
