<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 06 Feb 2017 10:46:09 +0000.
 */

namespace App\Models;
use Auth;
use Reliese\Database\Eloquent\Model as Eloquent;
use App\Classes\CommonFunctions;
use App\Classes\S3;

/**
 * Class ClientInfo
 * 
 * @property int $id
 * @property string $client_id
 * @property bool $right_click
 * @property string $client_code
 * @property int $group_id
 * @property string $marketing_name
 * @property string $legal_name
 * @property int $country_id
 * @property int $state_id
 * @property int $city_id
 * @property string $office_addres
 * @property int $pin_code
 * @property string $company_logo
 * @property int $brand_id
 * @property string $website
 * @property int $website_with
 * @property \Carbon\Carbon $created_date
 * @property int $created_by
 * @property \Carbon\Carbon $updated_date
 * @property int $updated_by
 *
 * @package App\Models
 */
class ClientInfo extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'right_click' => 'bool',
		'group_id' => 'int',
		'country_id' => 'int',
		'state_id' => 'int',
		'city_id' => 'int',
		'pin_code' => 'int',
		'brand_id' => 'int',
		'website_with' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'created_date',
		'updated_date'
	];

	protected $fillable = [
		'client_id',
                'client_key',
                'group_id',
                'brand_id',
                'country_id',
		'state_id',
		'city_id',
		'right_click',
		'marketing_name',
		'legal_name',
		'type_of_company',
		'office_addres',
		'pin_code',
		'company_logo',
		'brand_id',
		'website',
		'website_with',
		'created_date',
		'created_by',
		'updated_date',
		'updated_by'
	];
        
        public function getclientGroups()
        {
            return $this->belongsTo('App\Models\ClientGroup','group_id');
        }
        
        public function getlist($request)
        {
         
            if(!empty($request['id']) && $request['id'] !=0  )
            {
                $getClientLists = ClientInfo::where('id' ,  $request['id'])->first();
                if (!empty($getClientLists)) {
                    $result = ['success' => true, 'records' => $getClientLists];
                    return json_encode($result);
                } else {
                    $result = ['success' => false, 'message' => 'Something went wrong'];
                    return json_encode($result);
                }
            }
            else
            {    
                $getClientLists = ClientInfo::select('id','marketing_name','client_id','client_key','group_id','legal_name','website')
                                    ->with(['getclientGroups'=>function($query){
                                        $query->select('id','group_name');
                                    }])->get();
                if (!empty($getClientLists)) {
                    $result = ['success' => true, 'records' => $getClientLists];
                    return json_encode($result);
                } else {
                    $result = ['success' => false, 'message' => 'Something went wrong'];
                    return json_encode($result);
                }
            }
        } 
        
        
        public function createClientInfo($request)
        {
            $autoKey;
            $clientInfoCount = ClientInfo::count();
            if(empty($clientInfoCount))
                $autoKey=101;
            else
                $autoKey = 101 + $clientInfoCount;
            
            $create = CommonFunctions::insertMainTableRecords(Auth::guard('admin')->user()->id);
            $input['clientInfo'] = array_merge($request['data'],$create);
            $modelClientInfo = ClientInfo::create($input['clientInfo']);
            
            $clientId = $autoKey.'BMS'.@strtoupper(@substr($modelClientInfo->marketing_name,0,1).@substr($modelClientInfo->marketing_name,-1)).$modelClientInfo->id;
            
            $s3FolderName='client/'.$modelClientInfo->id."/";
            $marketingName = str_replace("'"," ",$modelClientInfo->marketing_name);
            $marketingName = str_replace('"'," ",$marketingName);
            $marketingName = str_replace(" ","_",$marketingName);
            
            $imageName = time()."_".@strtolower($marketingName).".".$request['data']['company_logo']->getClientOriginalExtension();
            
            $tempPath=$request['data']['company_logo']->getPathName();
            
            S3::s3FileUplod($tempPath, $imageName, $s3FolderName);
            
            $modelClientInfo->client_id = $clientId;
            $modelClientInfo->client_key = \Hash::make($clientId);
            $modelClientInfo->company_logo= $imageName;
            $modelClientInfo->update();
            
            $result = ['success' => true, 'result' => $modelClientInfo];
            return $result;
        } 
        
        
        public function updateClientInfo($request)
        {
            $company_Logo = $request['data']['company'];
            $company_Logo_flag=$request['data']['company_logo_flag'];
            
            unset($request['data']['company']);
            unset($request['data']['company_logo_flag']);
            
            $modelClientInfo = ClientInfo::where('id', $request['data']['id'])->first();
            if($company_Logo_flag == 1)
            { 
                $s3FolderName='client/'.$modelClientInfo->id."/";
                $marketingName = str_replace("'"," ",$modelClientInfo->marketing_name);
                $marketingName = str_replace('"'," ",$marketingName);
                $marketingName = str_replace(" ","_",$marketingName);
                $imageName = time()."_".@strtolower($marketingName).".".$request['data']['company_logo']->getClientOriginalExtension();
                $tempPath=$request['data']['company_logo']->getPathName();
                S3::s3FileUplod($tempPath, $imageName, $s3FolderName);
                
                $request['data']['company_logo'] = $imageName;
            }
            else
            {
                $request['data']['company_logo']= $company_Logo;
            }    
            
            $update = CommonFunctions::updateMainTableRecords(Auth::guard('admin')->user()->id);
            $input['clientInfo'] = array_merge($request['data'],$update);
            $modelClientInfo->update($input['clientInfo']);
            
            $result = ['success' => true];
            return $result;
        }        
}
