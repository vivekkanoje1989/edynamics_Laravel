<?php

namespace App\Models;
use Reliese\Database\Eloquent\Model as Eloquent;

class MlstCompanyTypes extends Eloquent
{
    protected $primaryKey = 'id';
    protected $connection = 'masterdb';
    protected $casts = [
            'id' => 'int',
            'status'=>'int',
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
		
            'type_of_company',
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
    
    public function getCompanyTypeList()
    {
        $getCompanyTypesList = MlstCompanyTypes::select('id','type_of_company','status')->where('status','=',1)->get();
        if (!empty($getCompanyTypesList)) {
                $result = ['success' => true, 'records' => $getCompanyTypesList];
                return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }        
}
