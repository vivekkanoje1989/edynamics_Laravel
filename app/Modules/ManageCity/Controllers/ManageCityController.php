<?php

namespace App\Modules\ManageCity\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\ManageCity\Models\MlstCities;
use Illuminate\Http\Request;
use App\Modules\ManageCountry\Models\MlstCountries;
use App\Modules\ManageStates\Models\MlstStates;
use DB;
use App\Classes\CommonFunctions;
use Auth;
use Excel;

class ManageCityController extends Controller {

    public function index() {
        return view("ManageCity::index");
    }

    public function manageCity() {
        $getCities = MlstCities::join('mlst_states', 'mlst_states.id', '=', 'mlst_cities.state_id')
                ->join('mlst_countries', 'mlst_states.country_id', '=', 'mlst_countries.id')
                ->select('mlst_cities.*', 'mlst_states.country_id', 'mlst_states.id as state_id', 'mlst_cities.name', 'mlst_states.name as state_name', 'mlst_countries.name as country_name')
                ->where(['mlst_cities.deleted_status' => 0])->get();
             
        if (!empty($getCities)) {            
            $result = ['success' => true, 'records' => $getCities, 'totalCount' => $getCities->count() ];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }
    public function manageStates() {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $getStates = MlstStates::where('country_id', $request['country_id'])
                ->select('id', 'name')
                ->get();
        if (!empty($getStates)) {
            $result = ['success' => true, 'records' => $getStates];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }
    public function manageCountry() {
        $getCountry = MlstCountries::all();

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
        
        $cnt = MlstCities::where(['name' => $request['name']])->where('deleted_status', '!=', 1)->get()->count();
       
        if ($cnt > 0) {
            $result = ['success' => false, 'errormsg' => 'City already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['cityData'] = array_merge($request, $create);            
           
            $result = MlstCities::create($input['cityData']);
            
            $last3 = MlstCities::latest('id')->first();
            $getState = MlstStates::where('id', '=', $request['state_id'])
                    ->select('name')
                    ->first();
            $result = ['success' => true, 'result' => $result,'lastinsertid' => $last3->id,'state_name' => $getState->name];
            return json_encode($result);
        }
    }
    public function update($id) {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $getCount = MlstCities::where(['name' => $request['name']])
                        ->where('id', '!=', $id)->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'City already exists'];
            return json_encode($result);
        } else {
            
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['cityData'] = array_merge($request, $create);
            $result = MlstCities::where('id', $id)->update($input['cityData']);
            $getState = MlstStates::where('id', '=', $request['state_id'])
                    ->select('name')
                    ->first();
            $result = ['success' => true, 'result' => $result, 'state_name' => $getState->name];
            return json_encode($result);
        }
    }

    /** viveknk
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         $getCount = MlstCities::where('id', '=', $id)->get()->count();
         if ($getCount < 1) {
              $result = ['success' => false, 'errormsg' => 'City does not exists'];
              return json_encode($result);
         } else {
            //  echo $id."destroy else"; exit;
              $loggedInUserId = Auth::guard('admin')->user()->id;
              $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
              $input['countryData'] = $delete;
  
              $result = MlstCities::where('id', $id)->update($input['countryData']);
              $result = MlstCities::where(['deleted_status' => 0])->get();
              $result = ['success' => true, 'result' => $result];
  
              return json_encode($result);
         }
     }

     //function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit;
		 
		$getCities = MlstCities::join('mlst_states', 'mlst_states.id', '=', 'mlst_cities.state_id')->join('mlst_countries', 'mlst_states.country_id', '=', 'mlst_countries.id')->select('mlst_states.country_id', 'mlst_states.id as state_id', 'mlst_cities.name', 'mlst_states.name as state_name', 'mlst_countries.name as country_name')->where(['mlst_cities.deleted_status' => 0])->get(); 	

        $getCount = $getCities->count();

        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Export Data', function($excel) use($getCities){
				$excel->sheet('Verticals', function($sheet) use($getCities){
					$sheet->fromArray($getCities);
				});
			})->export('xlsx');				
		}				
	}

}
