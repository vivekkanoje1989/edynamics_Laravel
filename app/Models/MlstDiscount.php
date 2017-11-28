<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 22 Sep 2017 09:53:23 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;
use App\Classes\CommonFunctions;
use Auth;

/**
 * Class MlstDiscount
 * 
 * @property int $id
 * @property string $discount_name
 * @property int $value_added_services_id
 * @property \Carbon\Carbon $created_date
 * @property \Carbon\Carbon $created_at
 * @property int $created_by
 * @property \Carbon\Carbon $updated_date
 * @property \Carbon\Carbon $updated_at
 * @property int $updated_by
 *
 * @package App\Models
 */
class MlstDiscount extends Eloquent
{
	protected $table = 'mlst_discount';
	public $incrementing = false;
         protected $connection = 'masterdb';

	protected $casts = [
		'id' => 'int',
		'value_added_services_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
//		'created_date',
//		'updated_date'
	];

	protected $fillable = [
		'id',
		'discount_name',
		'value_added_services_id',
		'created_date',
		'created_by',
		'updated_date',
		'updated_by'
	];
        
        
         public static function validationMessages(){
            $messages = array(
                'value_added_services_id.required' => 'Please select service',
                'discount_name.required' => 'Please enter discount name',
            );
            return $messages;
        }
        
        public static function validationRules(){
            $rules = array(
                'value_added_services_id' => 'required',
                'discount_name' => 'required',
                
            );
            return $rules;
        }
        
        
        public static function createDiscount($input = array()) {
            
            $getMacAddress = CommonFunctions::getMacAddress();
            $loginDateTime = date('Y-m-d H:i:s');
            $loginIP = $_SERVER['REMOTE_ADDR'];
            $loginBrowser = $_SERVER['HTTP_USER_AGENT'];
            $loginMacId = empty($getMacAddress) ? "" : $getMacAddress;
            
            if (!empty($input['loggedInUserId'])) {
                $loggedInUserId = $input['loggedInUserId'];
            } else {
                $loggedInUserId = Auth::guard('admin')->user()->id;
            }
            
            $affectedRows = new MlstDiscount();

            $affectedRows->value_added_services_id = $input['value_added_services_id'];
            $affectedRows->discount_name = $input['discount_name'];
            $affectedRows->created_date = date('Y-m-d');
            $affectedRows->created_by = $loggedInUserId;
            $affectedRows->save();
            return true;
            
        }

        public static function updateDiscount($input = array()) {
           
            $getMacAddress = CommonFunctions::getMacAddress();
            $loginDateTime = date('Y-m-d H:i:s');
            $loginIP = $_SERVER['REMOTE_ADDR'];
            $loginBrowser = $_SERVER['HTTP_USER_AGENT'];
            $loginMacId = empty($getMacAddress) ? "" : $getMacAddress;
            
            if (!empty($input['loggedInUserId'])) {
                $loggedInUserId = $input['loggedInUserId'];
            } else {
                $loggedInUserId = Auth::guard('admin')->user()->id;
            }
            $originalValues = MlstDiscount::where('id', $input['id'])->get();
            $affectedRows = MlstDiscount::where('id', '=', $input['id'])->update([
                'value_added_services_id'=>$input['value_added_services_id'],
		'discount_name'=>$input['discount_name'],
                'updated_date' => date('Y-m-d'),
                'updated_by' => $loggedInUserId,
                ]);
            return true;
        }
}
