<?php namespace App\Modules\ManageVerticals\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\ManageVerticals\Models\MlstBmsbVerticals;
use DB;
use App\Classes\CommonFunctions;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Excel;

class ManageVerticalsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("ManageVerticals::index")->with("loggedInUserId", Auth::guard('admin')->user()->id);
	}


	public function manageVerticals() {
        $getVertical = MlstBmsbVerticals::select('id', 'name')->where('deleted_status', '=', 0)->get();
		$VerticalCount = MlstBmsbVerticals::where('deleted_status', '=', 0)->get()->count();
        if (!empty($getVertical)) {
            $result = ['success' => true, 'records' => $getVertical, 'totalCount' => $VerticalCount ] ;
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
		echo "create";exit;		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//echo "store";exit;
		$postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = MlstBmsbVerticals::where(['name' => $request['name']])->where('deleted_status', '!=', 1)->get()->count();
        if ($cnt > 0) {
            $result = ['success' => false, 'errormsg' => 'Vertical already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
			$input['verticalData'] = array_merge($request, $create);			
			$result = MlstBmsbVerticals::create($input['verticalData']);			
			$getVertical = MlstBmsbVerticals::select('id', 'name')->where('deleted_status', '=', 0)->get();
			$VerticalCount = MlstBmsbVerticals::where('deleted_status', '=', 0)->get()->count();
            $result = ['success' => true, 'result' => $result, 'records' => $getVertical, 'totalCount' => $VerticalCount ];
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
		echo "edit";exit;
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

        $getCount = MlstBmsbVerticals::where(['name' => $request['name']])->where('id', '!=', $id)->where('deleted_status', '=', 0)->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Vertical already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['verticalData'] = array_merge($request, $create);
            $result = MlstBmsbVerticals::where('id', $request['id'])->update($input['verticalData']);
			$getVertical = MlstBmsbVerticals::select('id', 'name')->where('deleted_status', '=', 0)->get();
			$VerticalCount = MlstBmsbVerticals::where('deleted_status', '=', 0)->get()->count();
            $result = ['success' => true, 'result' => $result, 'records' => $getVertical, 'totalCount' => $VerticalCount ];
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
        $getCount = MlstBmsbVerticals::where('id', '=', $id)->get()->count();        
        if ($getCount < 1) {
             $result = ['success' => false, 'errormsg' => 'Vertical does not exists'];
             return json_encode($result);
        } else {
             $loggedInUserId = Auth::guard('admin')->user()->id;
             $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
             $input['verticalData'] = $delete; 
             $result = MlstBmsbVerticals::where('id', $id)->update($input['verticalData']);
			 $getVertical = MlstBmsbVerticals::select('id', 'name')->where('deleted_status', '=', 0)->get();
			 $VerticalCount = MlstBmsbVerticals::where('deleted_status', '=', 0)->get()->count();
			 $result = ['success' => true, 'result' => $result, 'records' => $getVertical, 'totalCount' => $VerticalCount ]; 
             return json_encode($result);
        }
	}

	//function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit;
		$getCount = MlstBmsbVerticals::where('deleted_status', '=', 0)->get()->count(); 
		$getVertical = MlstBmsbVerticals::select('id as SrNo', 'name as Verticals')->where('deleted_status', '=', 0)->get(); 		

        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Export Data', function($excel) use($getVertical){
				$excel->sheet('Verticals', function($sheet) use($getVertical){
					$sheet->fromArray($getVertical);
				});
			})->export('xlsx');				
		}				
	}

}
