<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 May 2017 11:42:17 +0530.
 */

namespace App\Models;
use App\Models\Product;
use Auth;
use App\Classes\CommonFunctions;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Product
 * 
 * @property int $product_id
 * @property string $product_name
 * @property int $status
 * @property \Carbon\Carbon $created_date
 * @property \Carbon\Carbon $created_at
 * @property int $created_by
 * @property string $created_IP
 * @property string $created_browser
 * @property string $created_mac_id
 * @property \Carbon\Carbon $updated_date
 * @property \Carbon\Carbon $updated_at
 * @property int $updated_by
 * @property string $updated_IP
 * @property string $updated_browser
 * @property string $updated_mac_id
 * @property int $deleted_status
 * @property \Carbon\Carbon $deleted_date
 * @property int $deleted_by
 * @property int $deleted_IP
 * @property int $deleted_browser
 * @property int $deleted_mac_id
 *
 * @package App\Models
 */
class Product extends Eloquent
{
	protected $primaryKey = 'product_id';

	protected $casts = [
		'status' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_status' => 'int',
		'deleted_by' => 'int',
		'deleted_IP' => 'int',
		'deleted_browser' => 'int',
		'deleted_mac_id' => 'int'
	];

	protected $dates = [
		'created_date',
		'updated_date',
		'deleted_date'
	];

	protected $fillable = [
		'product_name',
		'status',
		'created_date',
		'created_by',
		'created_IP',
		'created_browser',
		'created_mac_id',
		'updated_date',
		'updated_by',
		'updated_IP',
		'updated_browser',
		'updated_mac_id',
		'deleted_status',
		'deleted_date',
		'deleted_by',
		'deleted_IP',
		'deleted_browser',
		'deleted_mac_id'
	];
        
        
        public function getProductList()
        {
            $getProductLists = Product::all();
            if (!empty($getProductLists)) {
                $result = ['success' => true, 'records' => $getProductLists];
                return json_encode($result);
            } else {
                $result = ['success' => false, 'message' => 'Something went wrong'];
                return json_encode($result);
            }
        }
        
        
        public function createProduct($request)
        {
            
                $countProduct = Product::where(['product_name' => $request['product_name']])->get()->count();   
                if($countProduct)
                {
                    $result = ['success' => false, 'errormsg' => 'Product name already exists'];
                    return json_encode($result);  
                }  
                else 
                {
                    $loggedInUserId = Auth::guard('admin')->user()->id;
                    $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
                    $input['productInfo'] = array_merge($request,$create);
                    $modelProduct = Product::create($input['productInfo']);
                    $lastProduct= Product::latest('product_id')->first();

                    $result = ['success' => true, 'result' => $modelProduct,'lastRecordId'=>$lastProduct->product_id];
                    return json_encode($result);   

                }  
            
        }     
        
        
        public function updateProduct($request)
        {    
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['productInfo'] = array_merge($request,$update);
            $modelProduct = Product::where('product_id', $request['product_id'])->update($input['productInfo']);
            $result = ['success' => true, 'result' => $modelProduct];
            return json_encode($result);  
            
        }
        
        
        
        
}
