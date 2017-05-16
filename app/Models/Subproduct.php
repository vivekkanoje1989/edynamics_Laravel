<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 May 2017 18:33:39 +0530.
 */

namespace App\Models;
use Auth;
use App\Classes\CommonFunctions;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Subproduct
 * 
 * @property int $subproduct_id
 * @property string $subproduct_name
 * @property int $product_id
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
class Subproduct extends Eloquent
{
	protected $primaryKey = 'subproduct_id';

	protected $casts = [
		'product_id' => 'int',
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
		'subproduct_name',
		'product_id',
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
        
        /*relation with product table*/
        public function getProductInfo()
        {
            return $this->belongsTo('App\Models\Product','product_id');
        }
        
        
        /*listing the Sub product*/
        public function getSubProductList()
        {
            $getSubProductLists = Subproduct::select('subproduct_id','subproduct_name','product_id','status')
                                            ->with([
                                                    'getProductInfo'=>function($query){
                                                         $query->select('product_id','product_name');
                                                    }])
                                            ->get();
            if (!empty($getSubProductLists)) {
                $count=count($getSubProductLists);
                $result = ['success' => true, 'records' => $getSubProductLists,'count'=>$count];
                return json_encode($result);
            } else {
                $result = ['success' => false, 'message' => 'Something went wrong','count'=>0];
                return json_encode($result);
            }
        }
        
        
        /*creating the sub product*/
        public function createSubProduct($request)
        {
            $countSubProduct = Subproduct::where(['subproduct_name' => $request['subproduct_name']])->get()->count();   
            if($countSubProduct)
            {
                $result = ['success' => false, 'errormsg' => 'Sub Product name already exists'];
                return json_encode($result);  
            }  
            else 
            {
                $loggedInUserId = Auth::guard('admin')->user()->id;
                $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
                $input['subproductInfo'] = array_merge($request,$create);
                $modelSubProduct = Subproduct::create($input['subproductInfo']);
                $modelSubProduct= Subproduct::latest('subproduct_id')
                                                ->with([
                                                    'getProductInfo'=>function($query){
                                                         $query->select('product_id','product_name');
                                                    }])
                                                ->first();
                $result = ['success' => true, 'result' => $modelSubProduct];
                return json_encode($result);   

            }
            
            
        }      
        
        /*updating the sub product*/
        public function updateSubProduct($request)
        {
            $loggedInUserId = Auth::guard('admin')->user()->id;
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['subproductInfo'] = array_merge($request,$update);
            $modelSubProduct = Subproduct::where('subproduct_id', $request['subproduct_id'])->update($input['subproductInfo']);
            $modelSubProduct= Subproduct::select('subproduct_id','subproduct_name','product_id','status')
                                            ->where('subproduct_id', $request['subproduct_id'])
                                            ->with([
                                                    'getProductInfo'=>function($query){
                                                         $query->select('product_id','product_name');
                                                    }])
                                            ->first();
            $result = ['success' => true, 'result' => $modelSubProduct];
            return json_encode($result);
        }        
}
