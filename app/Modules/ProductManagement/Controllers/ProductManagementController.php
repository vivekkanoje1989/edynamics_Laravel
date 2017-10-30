<?php namespace App\Modules\ProductManagement\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Modules\ProductManagement\Models\ProductManagement;
use App\Modules\ProductManagement\Models\SubProduct;
use App\Modules\ProductManagement\Models\Pmodule;
use App\Modules\ProductManagement\Models\Submodule;
use App\Modules\Designations\Models\MlstBmsbDesignations;
use App\Models\backend\Employee;
use App\Classes\CommonFunctions;
use Auth;
use DB;
use App\Classes\S3;
use Excel;

class ProductManagementController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("ProductManagement::index");
	}

	public function showsub_products()
	{
		return view("ProductManagement::subproduct");
	}

	public function showmodule()
	{
		return view("ProductManagement::modulesP");
	}

	public function showsub_module()
	{
		return view("ProductManagement::submodule");
	}

	public function getproducts()
	{
		$getproduct = ProductManagement::where(['deleted_status' => 0])->get();
		$getCount = $getproduct->count();
		
		if ($getCount > 0) {
			$result = ['success' => true, 'records' => $getproduct, 'totalCount' => $getCount];
			return json_encode($result);
		} else {
			$result = ['success' => false, 'message' => 'Products Not Found.'];
			return json_encode($result);
		}
	}	

	public function getsubproducts()
	{	
		$newsbProduct = [];
		$newsbProductFnl = [];
		
		$getproducts = ProductManagement::where(['deleted_status' => 0])->get()->toArray();
		$sbproduct = SubProduct::where(['deleted_status' => 0])->get()->toArray();
		$sbproductCount = SubProduct::where(['deleted_status' => 0])->get()->count();
		if( $sbproductCount > 0 ){

			foreach($sbproduct as $sb){

				foreach($sb as $key=> $value){
					
					$newsbProduct[$key] = $value;

					if($key == 'product_id'){
						foreach($getproducts as $P){

							foreach($P as $k1=> $v1){							

								if($k1 == 'id' && $v1 == $value){
									$newsbProduct['product_name'] = $P['product_name'];
								}							
							}
						}
						
					}				

				}
				array_push($newsbProductFnl, $newsbProduct);			
			}

			$result = ['success' => true, 'records' => $newsbProductFnl, 'totalCount' => count($newsbProductFnl)];
            return json_encode($result);

		}else{
			$result = ['success' => false, 'records' => '', 'totalCount' => ''];
            return json_encode($result);
		}
	}

	public function getpmodules()
	{

		// $getpmodules = Pmodule::select('mlst_modules.*','mp.product_name','msp.sub_product_name','emp.first_name')->leftjoin('mlst_sub_products as msp','msp.id','=','mlst_modules.sub_product_id')->leftjoin('mlst_products as mp','mp.id','=','mlst_modules.product_id')->leftjoin('laravel_developement_edynamics.employees as emp','emp.id',IN('mlst_modules.developer_list'))->where(['mlst_modules.deleted_status' => 0])->get();
		// print_r($getpmodules);exit;
		$getpmodules = Pmodule::where(['deleted_status' => 0])->get()->toArray();
		$getCount = Pmodule::where(['deleted_status' => 0])->get()->count();

		$getproduct = ProductManagement::where(['deleted_status' => 0])->get()->toArray();

		$sbproduct = SubProduct::where(['deleted_status' => 0])->get()->toArray();

		$employees = Employee::where(['employee_status' => 1, 'deleted_status' => 0])->get()->toArray();
		
		$newmodule = [];
		$newmodulefnl = [];

		foreach($getpmodules as $key=> $value){
			foreach($value as $k1 => $v1){
				$newmodule[$k1] = $v1;

				if($k1 == 'product_id'){
					foreach($getproduct as $Pkey=> $Pvalue){
						foreach($Pvalue as $Pk1 => $Pv1){
							if($Pk1 == 'id'){
								if($Pv1 == $v1){
									$newmodule['product_name'] = $Pvalue['product_name'];
								}else{}
							}else{}
						}
					}
				}else{}//product_id

				if($k1 == 'sub_product_id'){
					foreach($sbproduct as $SPkey=> $SPvalue){
						foreach($SPvalue as $SPk1 => $SPv1){
							if($SPk1 == 'id'){
								if($SPv1 == $v1){
									$newmodule['sub_product_name'] = $SPvalue['sub_product_name'];
								}else{}
							}else{}
						}
					}	
				}else{}//sub_product_id

				if($k1 == 'developer_list'){
					
					$developer_listArr = explode(',' , $v1); 					

					$last = count($developer_listArr);
					
					$newmodule['developer_listNm'] = '';
					for ($i = 0; $i < $last; $i++){						
						
						foreach($employees as $Ekey=> $Evalue){
							
							foreach($Evalue as $Ek1 => $Ev1){
								if($Ek1 == 'employee_id'){
									if($Ev1 == $developer_listArr[$i]){
										$fnm = $Evalue['first_name'];
										$lnm = $Evalue['last_name'];
										$flnm = "$fnm $lnm";
										$NM = $flnm.',';
										$newmodule['developer_listNm'] .= $NM;
									}else{}
								}else{}
							}
						}	
						
					}
					$newmodule['developer_listNm'] = trim($newmodule['developer_listNm'], ',');
				}else{}//developer_list

				if($k1 == 'tester_list'){
						
					$tester_listArr = explode(',' , $v1); 					
	
					$lasts = count($tester_listArr);
						
					$newmodule['tester_listNm'] = '';
					for ($j = 0; $j < $lasts; $j++){						
						
						foreach($employees as $TEkey=> $TEvalue){
								
							foreach($TEvalue as $TEk1 => $TEv1){
								if($TEk1 == 'employee_id'){
									if($TEv1 == $tester_listArr[$j]){
										$Tfnm = $TEvalue['first_name'];
										$Tlnm = $TEvalue['last_name'];
										$Tflnm = "$Tfnm $Tlnm";
										$TNM = $Tflnm.',';
										$newmodule['tester_listNm'] .= $TNM;
									}else{}
								}else{}
							}
						}	
							
					}
					$newmodule['tester_listNm'] = trim($newmodule['tester_listNm'], ',');
				}else{}//tester_listNm

			}
			array_push($newmodulefnl, $newmodule);
		}
		
		
		// exit;
		if ($getCount > 0) {
			$result = ['success' => true, 'records' => $newmodulefnl, 'totalCount' => $getCount];
			return json_encode($result);
		} else {
			$result = ['success' => false, 'message' => 'Module Not Found.'];
			return json_encode($result);
		}
	}	


	public function getsubmodules()
	{
		$getsbmodules = Submodule::where(['deleted_status' => 0])->get()->toArray();
		$getCount = Submodule::where(['deleted_status' => 0])->get()->count();

		$getpmodules = Pmodule::where(['deleted_status' => 0])->get()->toArray();		

		$employees = Employee::where(['employee_status' => 1, 'deleted_status' => 0])->get()->toArray();
		
		$newmodule = [];
		$newmodulefnl = [];

		foreach($getsbmodules as $key=> $value){
			foreach($value as $k1 => $v1){
				$newmodule[$k1] = $v1;

				if($k1 == 'module_id'){
					foreach($getpmodules as $Pkey=> $Pvalue){
						foreach($Pvalue as $Pk1 => $Pv1){
							if($Pk1 == 'id'){
								if($Pv1 == $v1){
									$newmodule['module_name'] = $Pvalue['module_name'];
								}else{}
							}else{}
						}
					}
				}else{}//module_name				

				if($k1 == 'developer_list'){
					
					$developer_listArr = explode(',' , $v1); 					

					$last = count($developer_listArr);
					
					$newmodule['developer_listNm'] = '';
					for ($i = 0; $i < $last; $i++){						
						
						foreach($employees as $Ekey=> $Evalue){
							
							foreach($Evalue as $Ek1 => $Ev1){
								if($Ek1 == 'employee_id'){
									if($Ev1 == $developer_listArr[$i]){
										$fnm = $Evalue['first_name'];
										$lnm = $Evalue['last_name'];
										$flnm = "$fnm $lnm";
										$NM = $flnm.',';
										$newmodule['developer_listNm'] .= $NM;
									}else{}
								}else{}
							}
						}	
						
					}
					$newmodule['developer_listNm'] = trim($newmodule['developer_listNm'], ',');
				}else{}//developer_list

				if($k1 == 'tester_list'){
						
					$tester_listArr = explode(',' , $v1); 					
	
					$lasts = count($tester_listArr);
						
					$newmodule['tester_listNm'] = '';
					for ($j = 0; $j < $lasts; $j++){						
						
						foreach($employees as $TEkey=> $TEvalue){
								
							foreach($TEvalue as $TEk1 => $TEv1){
								if($TEk1 == 'employee_id'){
									if($TEv1 == $tester_listArr[$j]){
										$Tfnm = $TEvalue['first_name'];
										$Tlnm = $TEvalue['last_name'];
										$Tflnm = "$Tfnm $Tlnm";
										$TNM = $Tflnm.',';
										$newmodule['tester_listNm'] .= $TNM;
									}else{}
								}else{}
							}
						}	
							
					}
					$newmodule['tester_listNm'] = trim($newmodule['tester_listNm'], ',');
				}else{}//tester_listNm

			}
			array_push($newmodulefnl, $newmodule);
		}
		
		
		// exit;
		if ($getCount > 0) {
			$result = ['success' => true, 'records' => $newmodulefnl, 'totalCount' => $getCount];
			return json_encode($result);
		} else {
			$result = ['success' => false, 'message' => 'Module Not Found.'];
			return json_encode($result);
		}
	}	

	public function getdeveloper()
	{		
		$designationDevp = MlstBmsbDesignations::select('id','designation','status')->where(['designation' => 'Developer', 'deleted_status' => 0, 'status' => 1,])->get()->toArray();
		$getCount = MlstBmsbDesignations::select('id','designation','status')->where(['designation' => 'Developer', 'deleted_status' => 0, 'status' => 1,])->get()->count();		
		
		if($getCount > 0){
			$designationID = $designationDevp[0]['id'];			
		}else{
			$designationID = 0;
		}
		if($designationID != 0){
			$devloperlist = Employee::select('id', 'employee_id', 'first_name', 'last_name', 'designation_id', 'department_id')->where(['designation_id' => $designationID, 'deleted_status' => 0, 'employee_status' => 1,])->get()->toArray();			
			
			$newlist = [];
			$newlistFnl = [];
			foreach($devloperlist as $key => $dl){
				$fnm = '';
				$lnm = '';
				$dspnm = '';
				
				$devloperlist[$key]['dispay_name'] = $dl['first_name'] .' '. $dl['last_name'];
				// foreach($dl as $key => $value){					
				// 	$newlist[$key] = $value;
				// 	if($key =='first_name'){
				// 		$fnm = $value;
				// 	}else{}
					
				// 	if($key =='last_name'){
				// 		$lnm = $value;
				// 	}else{}
					
				// 	$dspnm = "$fnm $lnm";
				// 	$newlist['dispay_name'] = $dspnm;
				// }
				// array_push($newlistFnl, $newlist);
			}
			
			$result = ['success' => true, 'records' => $devloperlist];
			return json_encode($result);
		}else {
			$result = ['success' => false, 'message' => 'Module Not Found.'];
			return json_encode($result);
		}		
	}

	public function gettester()
	{
		$designationTstr = MlstBmsbDesignations::select('id','designation','status')->where(['designation' => 'Tester', 'deleted_status' => 0, 'status' => 1,])->get()->toArray();
		$getCount =MlstBmsbDesignations::select('id','designation','status')->where(['designation' => 'Tester', 'deleted_status' => 0, 'status' => 1,])->get()->count();
		
		if($getCount > 0){
			$designationID = $designationTstr[0]['id'];			
		}else{
			$designationID = 0;
		}

		if($designationID != 0){
			$testerlist = Employee::select('id', 'employee_id', 'first_name', 'last_name', 'designation_id', 'department_id')->where(['designation_id' => $designationID, 'deleted_status' => 0, 'employee_status' => 1,])->get()->toArray();			
			
			$newlist = [];
			$newlistFnl = [];
			foreach($testerlist as $key => $dl){
				$testerlist[$key]['dispay_name'] = $dl['first_name'] .' '. $dl['last_name'];
				// $fnm = '';
				// $lnm = '';
				// $dspnm = '';
				// foreach($dl as $key => $value){					
				// 	$newlist[$key] = $value;
				// 	if($key =='first_name'){
				// 		$fnm = $value;
				// 	}else{}
					
				// 	if($key =='last_name'){
				// 		$lnm = $value;
				// 	}else{}
					
				// 	$dspnm = "$fnm $lnm";
				// 	$newlist['dispay_name'] = $dspnm;
				// }
				// array_push($newlistFnl, $newlist);
			}
			$result = ['success' => true, 'records' => $testerlist];
			return json_encode($result);
		}else {
			$result = ['success' => false, 'message' => 'Module Not Found.'];
			return json_encode($result);
		}		
	}

	//Edit model get list separated by comma
	public function getdeveloperById(){

		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata, true);		

		$requestdata = (string)$request['devs'];
		
		$requestdata = explode(",", $requestdata);

		$newlist = [];
		$newlistFnl = [];

		foreach($requestdata as $key => $value){			

			$devloperlist = Employee::select('id', 'employee_id', 'first_name', 'last_name', 'designation_id', 'department_id')->where(['employee_id' => $value, 'deleted_status' => 0, 'employee_status' => 1])->get()->toArray();			
					
			foreach($devloperlist as $dl){
				$fnm = '';
				$lnm = '';
				$dspnm = '';
				foreach($dl as $keyD => $valueD){					
					$newlist[$keyD] = $valueD;
					if($keyD =='first_name'){
						$fnm = $valueD;
					}else{}
					
					if($keyD =='last_name'){
						$lnm = $valueD;
					}else{}
					
					$dspnm = "$fnm $lnm";
					$newlist['dispay_name'] = $dspnm;
				}
				array_push($newlistFnl, $newlist);
			}
		}

		$result = ['success' => true, 'records' => $newlistFnl];
		return json_encode($result);
	}	

	//Edit model get list separated by comma	
	public function gettesterById(){
		
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata, true);		

		$requestdata = (string)$request['testrs'];
		
		$requestdata = explode(",", $requestdata);
		
		$newlist = [];
		$newlistFnl = [];

		foreach($requestdata as $key => $value){		

			$testerlist = Employee::select('id', 'employee_id', 'first_name', 'last_name', 'designation_id', 'department_id')->where(['employee_id' => $value, 'deleted_status' => 0, 'employee_status' => 1])->get()->toArray();			
					
			foreach($testerlist as $dl){
				$fnm = '';
				$lnm = '';
				$dspnm = '';
				foreach($dl as $keyD => $valueD){					
					$newlist[$keyD] = $valueD;
					if($keyD =='first_name'){
						$fnm = $valueD;
					}else{}
					
					if($keyD =='last_name'){
						$lnm = $valueD;
					}else{}
					
					$dspnm = "$fnm $lnm";
					$newlist['dispay_name'] = $dspnm;
				}
				array_push($newlistFnl, $newlist);
			}
		}		

		$result = ['success' => true, 'records' => $newlistFnl];
		return json_encode($result);
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{		
		$postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = ProductManagement::where(['product_name' => $request['product_name']])->where('deleted_status', '!=', 1 )->get()->count();
        if ($cnt > 0) {  //exists Product
            $result = ['success' => false, 'errormsg' => 'Product already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['productsData'] = array_merge($request, $create);
            $products = ProductManagement::create($input['productsData']);
            $last3 = ProductManagement::latest('id')->first();
            $records = ProductManagement::where(['deleted_status' => 0])->get();
            // $result = ['success' => true, 'result' => $bloodgroup, 'lastinsertid' => $last3->id];
            $result = ['success' => true, 'records' => $records, 'totalCount' => count($records)];
            return json_encode($result);
        }
	}

	public function store_sbproduct()
	{		
		$postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $cnt = SubProduct::where(['sub_product_name' => $request['sub_product_name']])->where('deleted_status', '!=', 1 )->get()->count();
        if ($cnt > 0) {  //exists Product
            $result = ['success' => false, 'errormsg' => 'Sub Product already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['subproductsData'] = array_merge($request, $create);
            $products = SubProduct::create($input['subproductsData']);		
			
            $record = self::getsubproducts();
			$rec = json_decode($record)->records;

            $result = ['success' => true, 'records' => $rec, 'totalCount' => count($rec)];
            return json_encode($result);
        }
	}	

	public function store_pmodule()
	{	
		$input = Input::all();	

		$product_id = json_decode($input['mdata'])->product_id;
		$sub_product_id = json_decode($input['mdata'])->sub_product_id;
		$module_name = json_decode($input['mdata'])->pmodule;
		$description = json_decode($input['mdata'])->description;
		$developer_list = json_decode($input['mdata'])->developer_list;
		$tester_list = json_decode($input['mdata'])->tester_list;

		$developer_listAll = '';
		foreach($developer_list as $key => $value ){
			
			foreach($value as $k1 => $v1 ){
				
				if($k1 == 'employee_id'){					
					$developer_listAll .= $v1.",";
				}
			}
		}

		$developer_listAll = trim($developer_listAll, ',');		

		$tester_listAll = '';
		foreach($tester_list as $key => $value ){
			
			foreach($value as $k1 => $v1 ){
				
				if($k1 == 'employee_id'){					
					$tester_listAll .= $v1.",";
				}
			}
		}

		$tester_listAll = trim($tester_listAll, ',');

		$folderName = 'product_management';

		if($input[0]) {			
			$originalName = $input[0]->getClientOriginalName();			
			$originalPath = $input[0]->getPathName();
			$originalExt = $input[0]->getClientOriginalExtension();	
			$screenshot = time() . "." .$originalExt ;
			//upload screenshot to gcs
			S3::s3FileUpload($originalPath, $screenshot, $folderName);

			$requestdata['product_id'] = $product_id;
			$requestdata['sub_product_id'] = $sub_product_id;
			$requestdata['module_name'] = $module_name;
			$requestdata['screenshots'] = $screenshot;
			$requestdata['description'] = $description;
			$requestdata['developer_list'] = $developer_listAll;
			$requestdata['tester_list'] = $tester_listAll;

			$loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['moduleData'] = array_merge($requestdata, $create);
            $products = Pmodule::create($input['moduleData']);		
			
            // $record = self::getpmodules();
			// $rec = json_decode($record)->records;

			$rec = Pmodule::where(['deleted_status' => 0])->get();

            $result = ['success' => true, 'records' => $rec, 'totalCount' => count($rec)];
            return json_encode($result);

		}else{

		}
		
	}


	public function store_submodule()
	{	
		$input = Input::all();	

		$module_id = json_decode($input['mdata'])->module_id;
		$sub_module_name = json_decode($input['mdata'])->sub_module_name;		
		$description = json_decode($input['mdata'])->description;
		$developer_list = json_decode($input['mdata'])->developer_list;
		$tester_list = json_decode($input['mdata'])->tester_list;

		$developer_listAll = '';
		foreach($developer_list as $key => $value ){
			
			foreach($value as $k1 => $v1 ){
				
				if($k1 == 'employee_id'){					
					$developer_listAll .= $v1.",";
				}
			}
		}

		$developer_listAll = trim($developer_listAll, ',');		

		$tester_listAll = '';
		foreach($tester_list as $key => $value ){
			
			foreach($value as $k1 => $v1 ){
				
				if($k1 == 'employee_id'){					
					$tester_listAll .= $v1.",";
				}
			}
		}

		$tester_listAll = trim($tester_listAll, ',');

		$folderName = 'product_management';

		if(array_key_exists('0', $input)) {			
			// if($input[0]) {			
			$originalName = $input[0]->getClientOriginalName();			
			$originalPath = $input[0]->getPathName();
			$originalExt = $input[0]->getClientOriginalExtension();	
			$screenshot = time() . "." .$originalExt ;
			//upload screenshot to gcs
			S3::s3FileUpload($originalPath, $screenshot, $folderName);

			$requestdata['module_id'] = $module_id;
			$requestdata['sub_module_name'] = $sub_module_name;
			$requestdata['screenshots'] = $screenshot;
			$requestdata['description'] = $description;
			$requestdata['developer_list'] = $developer_listAll;
			$requestdata['tester_list'] = $tester_listAll;

			$loggedInUserId = Auth::guard('admin')->user()->id;
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            $input['sbmoduleData'] = array_merge($requestdata, $create);
            $products = Submodule::create($input['sbmoduleData']);		
			
            // $record = self::getsubproducts();
			// $rec = json_decode($record)->records;

			$rec = Submodule::where(['deleted_status' => 0])->get();

            $result = ['success' => true, 'records' => $rec, 'totalCount' => count($rec)];
            return json_encode($result);

		}else{

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

        $getCount = ProductManagement::where(['product_name' => $request['product_name']])->where('id', '!=', $id)->where('deleted_status', '=', 0 )->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Product already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['productsData'] = array_merge($request, $update);
            $result = ProductManagement::where('id', $id)->update($input['productsData']);

            // $result = ['success' => true, 'result' => $result];
			
            $records = ProductManagement::where(['deleted_status' => 0])->get();
            $result = ['success' => true, 'records' => $records, 'totalCount' => count($records)];
            return json_encode($result);
        }
	}
	


	public function update_sbproduct($id)
	{
		$postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $getCount = SubProduct::where(['sub_product_name' => $request['sub_product_name']])->where('id', '!=', $id)->where('deleted_status', '=', 0 )->get()->count();
        if ($getCount > 0) {
            $result = ['success' => false, 'errormsg' => 'Sub Product already exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['subproductsData'] = array_merge($request, $update);
            $result = SubProduct::where('id', $id)->update($input['subproductsData']);

            // $result = ['success' => true, 'result' => $result];
			$record = self::getsubproducts();
			$rec = json_decode($record)->records;
            // $records = SubProduct::where(['deleted_status' => 0])->get();
            $result = ['success' => true, 'records' => $rec, 'totalCount' => count($rec)];
            return json_encode($result);
        }
	}

	
	public function update_pmodule()
	{
		$input = Input::all();	

		// echo " ----input mda==";
		// echo "<pre>";
		// print_r(json_decode($input['mdata']));
		// echo " </pre>";

		$inptData = json_decode($input['mdata']);
		$id = $inptData->id;
		if($id){

			$product_id = $inptData->product_id;
			$sub_product_id = $inptData->sub_product_id;
			$module_name = $inptData->pmodule;
			$description = $inptData->description;
			$developer_list = $inptData->developer_list;
			$tester_list = $inptData->tester_list;			
			
			$developer_listAll = '';
			foreach($developer_list as $key => $value ){
				
				foreach($value as $k1 => $v1 ){
					
					if($k1 == 'employee_id'){					
						$developer_listAll .= $v1.",";
					}
				}
			}

			$developer_listAll = trim($developer_listAll, ',');		

			$tester_listAll = '';
			foreach($tester_list as $key => $value ){
				
				foreach($value as $k1 => $v1 ){
					
					if($k1 == 'employee_id'){					
						$tester_listAll .= $v1.",";
					}
				}
			}

			$tester_listAll = trim($tester_listAll, ',');

			$folderName = 'product_management';

			if(array_key_exists('0', $input)){
				// echo " ----input0==";
				// echo "<pre>";
				// print_r($input[0]);
				// echo " </pre>";


				$originalName = $input[0]->getClientOriginalName();			
				$originalPath = $input[0]->getPathName();
				$originalExt = $input[0]->getClientOriginalExtension();	
				$screenshot = time() . "." .$originalExt ;
				//upload screenshot to gcs
				S3::s3FileUpload($originalPath, $screenshot, $folderName);
				$requestdata['screenshots'] = $screenshot;

				$msg = 'Module screenshot is changed & ';

			}else{
				// echo "File not selected";
				$msg = 'Module screenshot is not changes but ';
				
			}

				$requestdata['product_id'] = $product_id;
				$requestdata['sub_product_id'] = $sub_product_id;
				$requestdata['module_name'] = $module_name;
				
				$requestdata['description'] = $description;
				$requestdata['developer_list'] = $developer_listAll;
				$requestdata['tester_list'] = $tester_listAll;

				$loggedInUserId = Auth::guard('admin')->user()->id;
				$update = CommonFunctions::updateMainTableRecords($loggedInUserId);
				$input['moduleData'] = array_merge($requestdata, $update);
				
				// echo " ----inputmoduleData==";
				// echo "<pre>";
				// print_r($input['moduleData']);
				// echo " </pre>";
				$products = Pmodule::where('id', $id)->update($input['moduleData']);
						
				
				$record = self::getpmodules();
				$rec = json_decode($record)->records;

				// $rec = Pmodule::where(['deleted_status' => 0])->get();

				$msg .= 'other deatails updated successfully.';

				$result = ['success' => true, 'records' => $rec, 'totalCount' => count($rec), 'message' => $msg];
				return json_encode($result);
		}else{
			$result = ['success' => false, 'message' => 'Something went wrong.' ];
			return json_encode($result);
		}
	}

	
	public function update_submodule()
	{
		$input = Input::all();	

		// echo " ----input mda==";
		// echo "<pre>";
		// print_r(json_decode($input['mdata']));
		// echo " </pre>";

		// exit;

		$inptData = json_decode($input['mdata']);
		$id = $inptData->id;
		if($id){

			$module_id = $inptData->module_id;
			$sub_module_name = $inptData->sub_module_name;			
			$description = $inptData->description;
			$developer_list = $inptData->developer_list;
			$tester_list = $inptData->tester_list;			
			
			$developer_listAll = '';
			foreach($developer_list as $key => $value ){
				
				foreach($value as $k1 => $v1 ){
					
					if($k1 == 'employee_id'){					
						$developer_listAll .= $v1.",";
					}
				}
			}

			$developer_listAll = trim($developer_listAll, ',');		

			$tester_listAll = '';
			foreach($tester_list as $key => $value ){
				
				foreach($value as $k1 => $v1 ){
					
					if($k1 == 'employee_id'){					
						$tester_listAll .= $v1.",";
					}
				}
			}

			$tester_listAll = trim($tester_listAll, ',');

			$folderName = 'product_management';

			if(array_key_exists('0', $input)){
				// echo " ----input0==";
				// echo "<pre>";
				// print_r($input[0]);
				// echo " </pre>";


				$originalName = $input[0]->getClientOriginalName();			
				$originalPath = $input[0]->getPathName();
				$originalExt = $input[0]->getClientOriginalExtension();	
				$screenshot = time() . "." .$originalExt ;
				//upload screenshot to gcs
				S3::s3FileUpload($originalPath, $screenshot, $folderName);
				$requestdata['screenshots'] = $screenshot;

				$msg = 'Sub Module screenshot is changed & ';

			}else{
				// echo "File not selected";
				$msg = 'Sub Module screenshot is not changes but ';
				
			}

				$requestdata['module_id'] = $module_id;
				$requestdata['sub_module_name'] = $sub_module_name;
				
				$requestdata['description'] = $description;
				$requestdata['developer_list'] = $developer_listAll;
				$requestdata['tester_list'] = $tester_listAll;

				$loggedInUserId = Auth::guard('admin')->user()->id;
				$update = CommonFunctions::updateMainTableRecords($loggedInUserId);
				$input['sbmoduleData'] = array_merge($requestdata, $update);
				
				// echo " ----inputmoduleData==";
				// echo "<pre>";
				// print_r($input['moduleData']);
				// echo " </pre>";
				$products = Submodule::where('id', $id)->update($input['sbmoduleData']);						
				
				$record = self::getsubmodules();
				$rec = json_decode($record)->records;				

				$msg .= 'other deatails updated successfully.';

				$result = ['success' => true, 'records' => $rec, 'totalCount' => count($rec), 'message' => $msg];
				return json_encode($result);
		}else{
			$result = ['success' => false, 'message' => 'Something went wrong.' ];
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
		$getCount = ProductManagement::where('id', '=', $id)->get()->count();
        if ($getCount < 1) {
            $result = ['success' => false, 'errormsg' => 'Product does not exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['productsData'] = $delete;

			$result = ProductManagement::where('id', $id)->update($input['productsData']);
			
			$records = ProductManagement::where(['deleted_status' => 0])->get();
            $result = ['success' => true, 'records' => $records, 'totalCount' => count($records)];
			return json_encode($result);
        }
	}

	
	public function destroy_subproduct($id)
	{	
		$getCount = SubProduct::where('id', '=', $id)->get()->count();
        if ($getCount < 1) {
            $result = ['success' => false, 'errormsg' => 'Sub Product does not exists'];
            return json_encode($result);
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
            $input['subproductsData'] = $delete;

			$result = SubProduct::where('id', $id)->update($input['subproductsData']);

			$record = self::getsubproducts();
			$rec = json_decode($record)->records;

            $result = ['success' => true, 'records' => $rec, 'totalCount' => count($rec)];
            return json_encode($result);
        }
	}

	public function destroy_module($id)
	{	
		if($id){
			$getCount = Pmodule::where('id', '=', $id)->get()->count();
			if ($getCount < 1) {
				$result = ['success' => false, 'message' => 'Module does not exists'];
				return json_encode($result);
			} else {
				$loggedInUserId = Auth::guard('admin')->user()->id;
				$delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
				$input['moduleData'] = $delete;

				$result = Pmodule::where('id', $id)->update($input['moduleData']);

				$record = self::getpmodules();
				$rec = json_decode($record)->records;

				$result = ['success' => true, 'records' => $rec, 'totalCount' => count($rec), 'message' => 'Record deleted successfully.'];
				return json_encode($result);
			}

		}else{
			$result = ['success' => false, 'message' => 'Something went wrong.'];
			return json_encode($result);
		}
	}

	public function destroy_submodule($id)
	{	
		if($id){
			$getCount = Submodule::where('id', '=', $id)->get()->count();
			if ($getCount < 1) {
				$result = ['success' => false, 'message' => 'Sub Module does not exists'];
				return json_encode($result);
			} else {
				$loggedInUserId = Auth::guard('admin')->user()->id;
				$delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);
				$input['sbmoduleData'] = $delete;

				$result = Submodule::where('id', $id)->update($input['sbmoduleData']);

				$record = self::getsubmodules();
				$rec = json_decode($record)->records;

				$result = ['success' => true, 'records' => $rec, 'totalCount' => count($rec), 'message' => 'Record deleted successfully.'];
				return json_encode($result);
			}

		}else{
			$result = ['success' => false, 'message' => 'Something went wrong.'];
			return json_encode($result);
		}
	}
}
