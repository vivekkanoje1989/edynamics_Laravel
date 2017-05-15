<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 May 2017 18:33:39 +0530.
 */

namespace App\Models;
use App\Models\Subproduct;
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
        
        
         public function getSubProductList()
        {
            $getSubProductLists = Subproduct::all();
            if (!empty($getSubProductLists)) {
                $result = ['success' => true, 'records' => $getSubProductLists];
                return json_encode($result);
            } else {
                $result = ['success' => false, 'message' => 'Something went wrong'];
                return json_encode($result);
            }
        }
}
