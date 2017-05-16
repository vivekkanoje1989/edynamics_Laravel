<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 Mar 2017 16:29:09 +0530.
 */

namespace App\Models;
use Auth;
use App\Classes\CommonFunctions;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ClientGroup
 * 
 * @property int $id
 * @property int $group_name
 *
 * @package App\Models
 */
class ClientGroup extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;
        protected $connection = 'mysql';
        

	protected $casts = [
		'id' => 'int',
		'group_name' => 'string'
	];

	protected $fillable = [
		'id',
		'group_name',
                'created_at',
                'created_by',
                'created_IP',
                'created_browser',
                'created_mac_id',
                'updated_date',
                'updated_at',
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
