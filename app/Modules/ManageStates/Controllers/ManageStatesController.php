<?php

namespace App\Modules\ManageStates\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ManageStates\Models\MlstStates;
use App\Classes\CommonFunctions;
use App\Modules\ManageCountry\Models\MlstCountries;
use DB;
use Auth;
use Excel;

class ManageStatesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view("ManageStates::index")->with("loggedInUserId", Auth::guard('admin')->user()->id);
    }

    public function manageStates() {

        $getState = MlstStates::join('mlst_countries', 'mlst_states.country_id', '=', 'mlst_countries.id')->select('mlst_states.id', 'mlst_states.name', 'mlst_states.country_id', 'mlst_countries.name as country_name')->where('mlst_states.deleted_status', '=', 0)->get();

        if (!empty($getState)) {
            $result = ['success' => true, 'records' => $getState, 'totalCount' => count($getState)];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

    public function manageCountry() {
        $getCountry = MlstCountries::where('deleted_status', '=', 0)->get();

        if (!empty($getCountry)) {
            $result = ['success' => true, 'records' => $getCountry];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

    public function store() {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = MlstStates::where(['name' => $request['name']])->where('deleted_status', '!=', 1)->get()->count();
        if ($cnt > 0) {
            $result = ['success' => false, 'errormsg' => 'State name already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['stateData'] = array_merge($request, $create);
            $result = MlstStates::create($input['stateData']);
            // $last3 = MlstStates::latest('id')->first();

            // $getCountry = MlstCountries::where('id', '=', $request['country_id'])
            //         ->select('name')
            //         ->first();
            // $input['stateData']['main_record_id'] = $last3->id;
            // $result = ['success' => true, 'result' => $result, 'lastinsertid' => $last3->id, 'country_name' => $getCountry->name];
            // return json_encode($result);

            $getState = MlstStates::join('mlst_countries', 'mlst_states.country_id', '=', 'mlst_countries.id')->select('mlst_states.id', 'mlst_states.name', 'mlst_states.country_id', 'mlst_countries.name as country_name')->where('mlst_states.deleted_status', '=', 0)->get();
            $result = ['success' => true, 'records' => $getState, 'totalCount' => count($getState)];
            return json_encode($result);
                    
        }
    }

    public function update($id) {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $getCount = MlstStates::where(['name' => $request['name'], 'country_id' => $request['country_id']])
                        ->where('id', '!=', $id)->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'State already exists'];
            return json_encode($result);
        } else {

            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['stateData'] = array_merge($request, $create);

            // $getCountry = MlstCountries::where('id', '=', $request['country_id'])->select('name')->first();

            $result = MlstStates::where('id', $request['id'])->update($input['stateData']);
            $getState = MlstStates::join('mlst_countries', 'mlst_states.country_id', '=', 'mlst_countries.id')->select('mlst_states.id', 'mlst_states.name', 'mlst_states.country_id', 'mlst_countries.name as country_name')->where('mlst_states.deleted_status', '=', 0)->get();
            $result = ['success' => true, 'records' => $getState, 'totalCount' => count($getState)];
            return json_encode($result);

            // $result = ['success' => true, 'result' => $result, 'country_name' => $getCountry->name];
            // return json_encode($result);
        }
    }

    //vivek delete
    public function destroy($id) { 
        $id = (Int)$id;      
        $getCount = MlstStates::where('id', '=', $id)->get()->count();        
        if ($getCount < 1) {
             $result = ['success' => false, 'errormsg' => 'State does not exists'];
             return json_encode($result);
        } else {
             $loggedInUserId = Auth::guard('admin')->user()->id;
             $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
             $input['stateData'] = $delete;
 
             $result = MlstStates::where('id', $id)->update($input['stateData']);
            //  $result = MlstStates::where(['deleted_status' => 0])->get();
            //  $result = ['success' => true, 'result' => $result, 'totalCount' => $getCount];
 
            //  return json_encode($result);
            $getState = MlstStates::join('mlst_countries', 'mlst_states.country_id', '=', 'mlst_countries.id')->select('mlst_states.id', 'mlst_states.name', 'mlst_states.country_id', 'mlst_countries.name as country_name')->where('mlst_states.deleted_status', '=', 0)->get();
            $result = ['success' => true, 'records' => $getState, 'totalCount' => count($getState)];
            return json_encode($result);
        }
    }

    //function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit;
        $getState =  MlstStates::join('mlst_countries', 'mlst_states.country_id', '=', 'mlst_countries.id')->select('mlst_states.id', 'mlst_states.name', 'mlst_states.country_id', 'mlst_countries.name as country_name')->where('mlst_states.deleted_status', '=', 0)->get();
        $getCount =  $getState->count();
        
        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Export Data', function($excel) use($getState){
				$excel->sheet('Verticals', function($sheet) use($getState){
					$sheet->fromArray($getState);
				});
			})->export('xlsx');				
		}				
	}
        

}
