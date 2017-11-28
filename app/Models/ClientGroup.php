<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 03 Apr 2017 15:28:04 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ClientGroup
 * 
 * @property int $id
 * @property string $group_name
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
class ClientGroup extends Eloquent
{
    
        protected $connection = 'masterdb';
        
	protected $casts = [
		'id' => 'int',
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
		'id',
		'group_name',
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
        
         public static function validationMessages(){
            $messages = array(
                'group_name.required' => 'Please enter group name',
            );
            return $messages;
        }
        public static function validationRules(){
            $rules = array(
                'group_name' => 'required',
            );
            return $rules;
        }
        
        
        /*|| ============= || Get all record of client group || ================= || */
        public function getlist()
        {
            
            $getClientGroupLists = ClientGroup::all();
            if (!empty($getClientGroupLists)) {
                $count=count($getClientGroupLists);
                $result = ['success' => true, 'records' => $getClientGroupLists,'count'=>$count];
                return json_encode($result);
            } else {
                $result = ['success' => false, 'message' => 'Something went wrong','count'=>$count];
                return json_encode($result);
            }
        }     
        
        /*|| =========== || Insertion and updation of client group || =========== || */
        public function process($request)
        {
            $countClientGroup = ClientGroup::where(['group_name' => $request['group_name']])->get()->count();   
            if($countClientGroup)
            {
                $result = ['success' => false, 'errormsg' => 'Group name already exists'];
                return json_encode($result);  
            }  
            else 
            {
                    $loggedInUserId = Auth::guard('admin')->user()->id;
                    if(empty($request['id']))
                    {
                       /* || === || insertion process || === || */
                        $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
                        $input['clientGroupInfo'] = array_merge($request,$create);
                        $modelClientGroup = ClientGroup::create($input['clientGroupInfo']);
                        $lastClientGroup = ClientGroup::latest('id')->first();
                        
                        $result = ['success' => true, 'result' => $modelClientGroup,'lastRecordId'=>$lastClientGroup->id];
                        return json_encode($result);   
                    }
                    else if(!empty($request['id']))
                    {
                        /* || === || updation process || === || */
                        $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
                        $input['clientGroupInfo'] = array_merge($request,$update);
                        $modelClientGroup = ClientGroup::where('id', $request['id'])->update($input['clientGroupInfo']);
                        $result = ['success' => true, 'result' => $modelClientGroup];

                     return json_encode($result);
                        
                        
                    }    
            }
            
            
        } 
}
