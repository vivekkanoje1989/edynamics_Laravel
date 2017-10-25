<?php namespace App\Modules\ProductManagement\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ProductManagement\Models\ProductManagement;
use App\Classes\CommonFunctions;
use Auth;
use DB;
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

}
