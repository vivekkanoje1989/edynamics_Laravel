<?php namespace App\Modules\Products\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            
            return view("Products::index");
	}
        
        /**
         * Get a listing of the product
        **/
        
        public function manageProducts()
        {
            $model = new Product();
            return $model->getProductList();            
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
