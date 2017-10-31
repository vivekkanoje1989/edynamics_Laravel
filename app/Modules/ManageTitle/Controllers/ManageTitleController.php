<?php namespace App\Modules\ManageTitle\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\ManageTitle\Models\mlsttitles;
use App\Classes\CommonFunctions;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Auth;
use DB;
use Excel;

class ManageTitleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("ManageTitle::index")->with("loggedInUserId", Auth::guard('admin')->user()->id);
	}

	public function getTitle() {
        $getTitles = mlsttitles::select('id', 'title', 'status')->where('deleted_status', '=', 0)->get();
		$getTitlesCount = $getTitles->count();
        if (!empty($getTitles)) {
            $result = ['success' => true, 'records' => $getTitles, 'totalCount' => $getTitlesCount ] ;
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
		//echo "store";exit;
		$postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = mlsttitles::where(['title' => $request['title']])->where('deleted_status', '=', 0)->get()->count();
        if ($cnt > 0) {
            $result = ['success' => false, 'errormsg' => 'Title already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
			$input['titleData'] = array_merge($request, $create);			
			$result = mlsttitles::create($input['titleData']);			
			$getTitle = mlsttitles::select('id', 'title', 'status')->where('deleted_status', '=', 0)->get();
			$getTitleCount = $getTitle->count();
			$last_insertedId = mlsttitles::latest('id')->first();
            $result = ['success' => true, 'result' => $result, 'records' => $getTitle,'last_insertedId' => $last_insertedId, 'totalCount' => $getTitleCount ];
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
        $getCount = mlsttitles::where('id', '!=', $id)->where(['title' => $request['title']])->where('deleted_status', '=', 0)->get()->count();
		
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Title already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['titleData'] = array_merge($request, $create);
            $result = mlsttitles::where('id', $request['id'])->update($input['titleData']);		
			
			$getTitle = mlsttitles::select('id', 'title', 'status')->where('deleted_status', '=', 0)->get();
			$getTitleCount = $getTitle->count();
			$last_updatedId = $request['id'];
            $result = ['success' => true, 'result' => $result, 'records' => $getTitle,'last_updatedId' => $last_updatedId, 'totalCount' => $getTitleCount ];
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
        $getCount = mlsttitles::where('id', '=', $id)->get()->count();        
        if ($getCount < 1) {
             $result = ['success' => false, 'errormsg' => 'Title does not exists'];
             return json_encode($result);
        } else {
             $loggedInUserId = Auth::guard('admin')->user()->id;
             $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
             $input['titleData'] = $delete; 
             $result = mlsttitles::where('id', $id)->update($input['titleData']);
			 $getTitle = mlsttitles::select('id', 'title', 'status')->where('deleted_status', '=', 0)->get();
			 $getTitleCount = $getTitle->count();
			 $result = ['success' => true, 'result' => $result, 'records' => $getTitle, 'totalCount' => $getTitleCount ];
			 return json_encode($result);
        }
	}

	//function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit; 
		$getTitle = mlsttitles::select('id as Sr.No.', 'title as Title', 'Status')->where('deleted_status', '=', 0)->get(); 		
		$getTitleCount = $getTitle->count();
        if ($getTitleCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Title Names', function($excel) use($getTitle){
				$excel->sheet('Titles', function($sheet) use($getTitle){
					$sheet->fromArray($getTitle);
				});
			})->export('xlsx');				
		}				
	}

}