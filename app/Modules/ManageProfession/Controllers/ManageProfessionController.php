<?php

namespace App\Modules\ManageProfession\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ManageProfession\Models\MlstProfessions;
use DB;
use App\Classes\CommonFunctions;
use Auth;
use Excel;
class ManageProfessionController extends Controller {

    public function index() {
        return view("ManageProfession::index");
    }

    public function manageProfession() {
        $getProfession = MlstProfessions::select('profession','status','id')->where('deleted_status','=',0)->get();
        $getCount = $getProfession->count();
        if (!empty($getProfession)) {
            $result = ['success' => true, 'records' => $getProfession, 'totalCount' => $getCount ];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }
    
    public function store() {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = MlstProfessions::where(['profession' => $request['profession']])->where('deleted_status','=',0)->get()->count();
        if ($cnt > 0) {
            $result = ['success' => false, 'errormsg' => 'Profession already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id; 
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['professionData'] = array_merge($request, $create);
            $result = MlstProfessions::create($input['professionData']);
            $last3 = MlstProfessions::latest('id')->first();
            $input['professionData']['main_record_id'] = $last3->id;

            $result = ['success' => true, 'result' => $result, 'lastinsertid' => $last3->id];
            return json_encode($result);
        }
    }
    public function update($id) {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $getCount = MlstProfessions::where(['profession' => $request['profession']])->where('id','!=',$id)->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'profession already exists'];
          return json_encode($result);
        } else {

            $loggedInUserId = Auth::guard('admin')->user()->id;
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['professionData'] = array_merge($request, $update);
            $originalValues = MlstProfessions::where('id', $request['id'])->get();
            $result = MlstProfessions::where('id', $request['id'])->update($input['professionData']);
            $result = ['success' => true, 'result' => $result];
          return json_encode($result);
        }
    }

    public function destroy($id) {

        $getCount = MlstProfessions::where('id','=',$id)->get()->count();
        if ($getCount < 1) {
            $result = ['success' => false, 'errormsg' => 'profession can not be deleted'];
            return json_encode($result);
        } else {

            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['professionData'] = $delete;
            $result = MlstProfessions::where('id', $id)->update($input['professionData']);
            $getProfession = MlstProfessions::select('profession','status','id')->where('deleted_status','=',0)->get();
            $result = ['success' => true, 'result' => $result, 'records' => $getProfession];
            return json_encode($result);
        }
    }

    //function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit;
		$getProfession = MlstProfessions::select('id','profession','status')->where('deleted_status','=',0)->get();
        $getCount = $getProfession->count();

        if ($getCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Export Data', function($excel) use($getProfession){
				$excel->sheet('Verticals', function($sheet) use($getProfession){
					$sheet->fromArray($getProfession);
				});
			})->export('xlsx');				
		}				
	}
}
