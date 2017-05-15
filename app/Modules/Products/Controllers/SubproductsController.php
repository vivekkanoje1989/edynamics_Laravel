<?php namespace App\Modules\Products\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Subproduct;
use Illuminate\Http\Request;

class SubproductsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            
            return view("Products::index_subproduct");
	}
        
        /**
         * Get a listing of the product
        **/
        
        public function manageSubProducts()
        {
            $model = new Subproduct();
            return $model->getSubProductList();            
        }        
        
        
        
	public function store()
	{
            $postdata = file_get_contents('php://input');
            $request = json_decode($postdata, true);
            $model = new Product();
            return $model->createProduct($request);
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
            $model = new Product();
            return $model->updateProduct($request);
	}

	

}
