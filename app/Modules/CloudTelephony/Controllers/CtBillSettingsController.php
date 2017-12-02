<?php

namespace App\Modules\CloudTelephony\Controllers;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\EmployeesDevice;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use File;
use DB;
use Illuminate\Http\Request;
use App\Classes\CommonFunctions;
use App\Models\CtBillingSetting;

class CtBillSettingsController extends Controller {

    public function __construct() {
        $this->middleware('web');
    }
    
    public function index($id)
    {
            return view("CloudTelephony::ctnumberslist")->with("clientId", $id);
    }
        
    public function manageClientCtnumbers()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        
        if (!empty($request['client_id']) && $request['client_id'] != 0) {
        
            $manageLists = DB::select('CALL proc_manage_ctbillingsettings('.$request["client_id"].')');
            
            if ($manageLists) {            
            $result = ['success' => true, "records" => ["data" => $manageLists, "total" => count($manageLists), 'per_page' => count($manageLists), "current_page" => 1, "last_page" => 1, "next_page_url" => null, "prev_page_url" => null, "from" => 1, "to" => count($manageLists)]];
                echo json_encode($result);
            } else {
                
                $manageLists = \App\Models\ClientInfo::select('marketing_name')->where('id',$request['client_id'])->first();
                $result = ['success' => false, 'message' => 'Numbers not allocated to this client' ,"records" => ["data" => $manageLists]];
                echo json_encode($result);
               
            }
        }else{
             $result = ['success' => false, 'message' => 'Something went wrong. Please check internet connection or try again'];
             echo json_encode($result);
        }
        
    }
    
    public function getCtnumber()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        
        if (!empty($request['ctnumberid']) && $request['ctnumberid'] != 0) {
            $manageNumber = CtBillingSetting::where('id',$request['ctnumberid'])->first();
            if(!empty($manageNumber)){
            $result = ['success' => true,"records" => ["data" => $manageNumber]];
            echo json_encode($result);
            }else
            {
             $result = ['success' => false, 'message' => 'Numbers not exist'];
             echo json_encode($result);
            }
               
           
        }else{
             $result = ['success' => false, 'message' => 'Something went wrong. Please check internet connection or try again'];
             echo json_encode($result);
        }
        
    }
    
    public function addCtnumbers()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        print_r($request);exit;
        
        if (!empty($request['ctnumbersData'])){
            
                    $affectedRows = new CtBillingSetting();
                    
                    if($request['ctnumbersData']['number_status'] == 4)
                    {
                        $affectedRows->deactivation_date = date('Y-m-d',strtotime($request['ctnumbersData']['deactivation_date']));
                    }else
                    {
                        $affectedRows->deactivation_date = '0000-00-00';
                    }
                    
                    
                    $affectedRows->client_id = $request['ctnumbersData']['client_id'];
                    $affectedRows->virtual_number = $request['ctnumbersData']['virtual_number'];
                    $affectedRows->display_number = $request['ctnumbersData']['display_number'];
                    $affectedRows->default_number = $request['ctnumbersData']['default_number'];
                    $affectedRows->incoming_call_status = $request['ctnumbersData']['incoming_call_status'];            
                    $affectedRows->incoming_pulse_duration = $request['ctnumbersData']['incoming_pulse_duration'];
                    $affectedRows->incoming_pulse_rate = $request['ctnumbersData']['incoming_pulse_rate'];
                    $affectedRows->outbound_call_status = $request['ctnumbersData']['outbound_call_status'];
                    $affectedRows->local_outbound_pulse_duration = !empty($request['ctnumbersData']['local_outbound_pulse_duration']) ? $request['ctnumbersData']['local_outbound_pulse_duration'] : 0;
                    $affectedRows->isd_outbound_pulse_duration = !empty($request['ctnumbersData']['isd_outbound_pulse_duration']) ? $request['ctnumbersData']['isd_outbound_pulse_duration'] : 0;
                    $affectedRows->local_outbound_pulse_rate = !empty($request['ctnumbersData']['local_outbound_pulse_rate']) ? $request['ctnumbersData']['local_outbound_pulse_rate'] : 0;
                    $affectedRows->isd_outbound_pulse_rate = !empty($request['ctnumbersData']['isd_outbound_pulse_rate']) ? $request['ctnumbersData']['isd_outbound_pulse_rate'] : 0;
                    $affectedRows->dial_outbound_callas = !empty($request['ctnumbersData']['dial_outbound_callas']) ? $request['ctnumbersData']['dial_outbound_callas'] : 0;
                    $affectedRows->rent_amount = $request['ctnumbersData']['rent_amount'];
                    $affectedRows->number_status = $request['ctnumbersData']['number_status'];
                    $affectedRows->activation_date = date('Y-m-d', strtotime($request['ctnumbersData']['activation_date']));
                    $affectedRows->created_by = Auth()->guard('admin')->user()->id;
                    
                 if($affectedRows->save()){
                     $result = ['success' => true, "records" => 'Number Added Successfully !'];
                     echo json_encode($result);
                 }else{
                      $result = ['success' => false, 'message' => 'Something went wrong. try again'];
                      echo json_encode($result);
                 }
        }
        
    }
    
    
    public function updateCtnumbers()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
//        print_r($request);exit;
        if(!empty($request['ctnumbersData']['id'])){
            
            $ctnumberdata['data']['client_id'] = $request['ctnumbersData']['client_id'];
            $ctnumberdata['data']['virtual_number'] = $request['ctnumbersData']['virtual_number'];
            $ctnumberdata['data']['display_number'] = $request['ctnumbersData']['display_number'];
            $ctnumberdata['data']['default_number'] = $request['ctnumbersData']['default_number'];
            $ctnumberdata['data']['incoming_call_status'] = $request['ctnumbersData']['incoming_call_status'];            
            $ctnumberdata['data']['incoming_pulse_duration'] = !empty($request['ctnumbersData']['incoming_pulse_duration']) ? $request['ctnumbersData']['incoming_pulse_duration']: 0;
            $ctnumberdata['data']['incoming_pulse_rate'] = !empty($request['ctnumbersData']['incoming_pulse_rate']) ? $request['ctnumbersData']['incoming_pulse_rate'] : 0;
            $ctnumberdata['data']['outbound_call_status'] = !empty($request['ctnumbersData']['outbound_call_status']) ? $request['ctnumbersData']['outbound_call_status'] : 0;
            $ctnumberdata['data']['local_outbound_pulse_duration'] = !empty($request['ctnumbersData']['local_outbound_pulse_duration']) ? $request['ctnumbersData']['local_outbound_pulse_duration'] : 0;
            $ctnumberdata['data']['isd_outbound_pulse_duration'] = !empty($request['ctnumbersData']['isd_outbound_pulse_duration']) ? $request['ctnumbersData']['isd_outbound_pulse_duration'] : 0;
            $ctnumberdata['data']['local_outbound_pulse_rate'] = !empty($request['ctnumbersData']['local_outbound_pulse_rate']) ? $request['ctnumbersData']['local_outbound_pulse_rate'] : 0;
            $ctnumberdata['data']['isd_outbound_pulse_rate'] = !empty($request['ctnumbersData']['isd_outbound_pulse_rate']) ? $request['ctnumbersData']['isd_outbound_pulse_rate'] : 0;
            $ctnumberdata['data']['dial_outbound_callas'] = !empty($request['ctnumbersData']['dial_outbound_callas']) ? $request['ctnumbersData']['dial_outbound_callas'] : 0;
            $ctnumberdata['data']['rent_amount'] = $request['ctnumbersData']['rent_amount'];
            $ctnumberdata['data']['activation_date'] = date('Y-m-d', strtotime($request['ctnumbersData']['activation_date']));
            $ctnumberdata['data']['number_status'] = $request['ctnumbersData']['number_status'];
            if($request['ctnumbersData']['number_status'] == 4)
            {
                $ctnumberdata['data']['deactivation_date'] = date('Y-m-d',strtotime($request['ctnumbersData']['deactivation_date']));
            }else
            {
                $ctnumberdata['data']['deactivation_date'] = '0000-00-00';
            }
            
            $ctnumberdata['data']['updated_by'] = Auth()->guard('admin')->user()->id;
          
            $affectedRows = CtBillingSetting::where('id', '=', $request['ctnumbersData']['id'])->update($ctnumberdata['data']);
           
            if($affectedRows){
                $result = ['success' => true, "records" => 'Number Updated Successfully !'];
                echo json_encode($result);
            }else{
                $result = ['success' => false, 'message' => 'Something went wrong. try again'];
                echo json_encode($result);
            }
        
        }else
        {
            $result = ['success' => false, 'message' => 'Id Not Exist'];
             echo json_encode($result);
        }
        
       
        
    }
    


    
}
