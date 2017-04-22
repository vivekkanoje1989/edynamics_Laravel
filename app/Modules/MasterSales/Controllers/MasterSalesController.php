<?php namespace App\Modules\MasterSales\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Modules\MasterSales\Models\Customer;
use App\Modules\MasterSales\Models\CustomersLog;
use App\Modules\MasterSales\Models\CustomersContact;
use App\Modules\MasterSales\Models\CustomersContactsLog;
use Validator;
use DB;
use Auth;
use App\Classes\CommonFunctions;
class MasterSalesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            return view("MasterSales::index");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return view("MasterSales::create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            try
            {
                $postdata = file_get_contents("php://input");
                $input  = json_decode($postdata, true);

                if(empty($input)){
                    $input = Input::all();
                    $loggedInUserId = Auth::guard('admin')->user()->id;
                }else{
                    $loggedInUserId = $input['customerData']['loggedInUserId'];
                }
                $validationRules = Customer::validationRules();
                $validationMessages = Customer::validationMessages();
                $userAgent = $_SERVER['HTTP_USER_AGENT'];

                if(!empty($input['customerData'])){
                    $validator = Validator::make($input['customerData'], $validationRules, $validationMessages);
                    if ($validator->fails()) {
                        $result = ['success' => false, 'message' => $validator->messages()];
                        return json_encode($result,true);
                    }
                } 
                $input['customerData']['birth_date'] =  date('Y-m-d', strtotime($input['customerData']['birth_date']));
                $input['customerData']['marriage_date'] =  date('Y-m-d', strtotime($input['customerData']['marriage_date']));
                $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
                $input['customerData'] = array_merge($input['customerData'],$create);
                $createCustomer = Customer::create($input['customerData']); //insert data into employees table
                CustomersLog::create($input['customerData']);  
                $input['customerData']['main_record_id'] = $createCustomer->id;
                $input['customerData']['record_type'] = 1;
                $input['customerData']['record_restore_status'] = 1;
                
                $createCustomerId = $createCustomer->id;
                if(!empty($input['customerContacts'])){
                    foreach($input['customerContacts'] as $contacts){
                        $contacts['customer_id'] = (int)$createCustomerId;
                        $contacts['mobile_optin_status'] = $contacts['mobile_verification_status'] = $contacts['landline_optin_status'] = 
                        $contacts['landline_verification_status'] = $contacts['landline_alerts_status'] =  $contacts['email_optin_status'] = 
                        $contacts['email_verification_status'] = $contacts['mobile_verification_timestamp'] = 0;
                        $contacts['mobile_optin_info'] = $contacts['mobile_verification_details'] = $contacts['mobile_alerts_inactivation_details'] =
                        $contacts['landline_optin_info'] = $contacts['landline_verification_details'] = $contacts['landline_alerts_inactivation_details'] = 
                        $contacts['email_optin_info'] = $contacts['email_verification_details'] = $contacts['email_alerts_inactivation_details'] = NULL;
                        $contacts['mobile_alerts_status'] = $contacts['landline_alerts_status'] = $contacts['email_alerts_status'] = 1;
                        $contacts['mobile_alerts_inactivation_timestamp'] = $contacts['landline_verification_timestamp'] = $contacts['landline_alerts_inactivation_timestamp'] =  $contacts['email_verification_timestamp'] = 
                        $contacts['email_alerts_inactivation_timestamp'] = "0000-00-00 00:00:00";

                        if (!empty($contacts['mobile_number'])) {
                            $mobileNumber = explode("-", $contacts['mobile_number']); 
                            $contacts['mobile_calling_code'] = !empty($mobileNumber[1]) ?  (int) $mobileNumber[0] : "";
                            $contacts['mobile_number'] = (!empty($mobileNumber[1])) ? (int) $mobileNumber[1] : "";
                        }

                        if (!empty($contacts['landline_number'])) {
                            $landlineNumber = explode("-", $contacts['landline_number']);
                            $contacts['landline_calling_code'] = (!empty($landlineNumber[1])) ?  (int) $landlineNumber[0] : "";
                            $contacts['landline_number'] = (!empty($landlineNumber[1])) ? (int) $landlineNumber[1] : "";
                        }
                        $contacts = array_merge($contacts,$create);
                        CustomersContact::create($contacts); //insert data into customer_contacts table
                        CustomersContactsLog::create($contacts); //insert data into customer_contacts_logs table
                    }
                }
            }
            catch (\Exception $ex) {
                $result = ["success" => false, "status" => 412, "message" => $ex->getMessage()];
                return json_encode($result);
            }
            $result = ["success" => true, "customerId" => $createCustomer->id];
            return json_encode($result);        
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            try
            {
                $originalValues = Customer::where('id', $id)->get();
                $originalContactValues = CustomersContact::where('customer_id', $id)->get();
                $postdata = file_get_contents("php://input");
                $input  = json_decode($postdata, true);

                if(empty($input)){
                    $input = Input::all();
                    $loggedInUserId = Auth::guard('admin')->user()->id;
                    $validationRules = Customer::validationRules();
                    $validationMessages = Customer::validationMessages();
                    if(!empty($input['customerData'])){
                        $validator = Validator::make($input['customerData'], $validationRules, $validationMessages);
                        if ($validator->fails()) {
                            $result = ['success' => false, 'message' => $validator->messages()];
                            return json_encode($result,true);
                        }
                    }
                }else{
                    $loggedInUserId = $input['customerData']['loggedInUserId'];
                }
                unset($input['customerData']['loggedInUserId']);
                unset($input['customerData']['id']);
                
                $validationRules = Customer::validationRules();
                $validationMessages = Customer::validationMessages();
                if(!empty($input['customerData'])){
                    $validator = Validator::make($input['customerData'], $validationRules, $validationMessages);
                    if ($validator->fails()) {
                        $result = ['success' => false, 'message' => $validator->messages()];
                        return json_encode($result,true);
                    }
                }else{
                    $loggedInUserId = $input['customerData']['loggedInUserId'];
                    unset($input['customerData']['loggedInUserId']);
                    unset($input['customerData']['id']);
                }

                $input['customerData']['birth_date'] =  date('Y-m-d', strtotime($input['customerData']['birth_date']));
                $input['customerData']['marriage_date'] =  date('Y-m-d', strtotime($input['customerData']['marriage_date']));
                $input['customerData']['created_date'] =  date('Y-m-d', strtotime($input['customerData']['created_date']));            
                $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
                $input['customerData'] = array_merge($input['customerData'],$update);
                //echo json_encode($input);exit;
                $updateCustomer = Customer::where('id',$id)->update($input['customerData']); //insert data into employees table
                
                $getResult = array_diff_assoc($originalValues[0]['attributes'], $input['customerData']);
                $implodeArr =  implode(",",array_keys($getResult));
                if ($updateCustomer == 1) {
                    $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
                    $input['customerData'] = array_merge($input['customerData'],$create);
                    $input['customerData']['main_record_id'] = $id;
                    $input['customerData']['record_type'] = 2;
                    $input['customerData']['column_names'] = $implodeArr;
                    $input['customerData']['record_restore_status'] = 1;
//                    CustomersLog::create($input['customerData']);   
                }            
                
                if(!empty($input['customerContacts'])){
                    $i = 0;
                    foreach($input['customerContacts'] as $contacts){
                        unset($contacts['$$hashKey']);
                        $contacts['mobile_optin_status'] = $contacts['mobile_verification_status'] = $contacts['landline_optin_status'] = 
                        $contacts['landline_verification_status'] = $contacts['landline_alerts_status'] =  $contacts['email_optin_status'] = 
                        $contacts['email_verification_status'] = 0;
                        $contacts['mobile_optin_info'] = $contacts['mobile_verification_details'] = $contacts['mobile_alerts_inactivation_details'] =
                        $contacts['landline_optin_info'] = $contacts['landline_verification_details'] = $contacts['landline_alerts_inactivation_details'] = 
                        $contacts['email_optin_info'] = $contacts['email_verification_details'] = $contacts['email_alerts_inactivation_details'] = NULL;
                        $contacts['mobile_alerts_status'] = $contacts['landline_alerts_status'] = $contacts['email_alerts_status'] = 1;
                        $contacts['mobile_verification_timestamp'] = $contacts['mobile_alerts_inactivation_timestamp'] = $contacts['landline_verification_timestamp'] = 
                        $contacts['landline_alerts_inactivation_timestamp'] = $contacts['email_verification_timestamp'] = 
                        $contacts['email_alerts_inactivation_timestamp'] = "0000-00-00 00:00:00";
                        
                        if (preg_match("/^(\+\d{1,4}-)\d{10}+$/",$contacts['mobile_number']))
                        {
                            if (!empty($contacts['mobile_number'])) {
                                $mobileNumber = explode("-", $contacts['mobile_number']);
                                $calling_code = (int) $mobileNumber[0];                        
                                $contacts['mobile_calling_code'] = !empty($mobileNumber[1]) ? $calling_code : "";
                                $contacts['mobile_number'] = !empty($mobileNumber[1]) ? (int) $mobileNumber[1] : "";
                            }
                            if (!empty($contacts['landline_number'])) {
                                $landlineNumber = explode("-", $contacts['landline_number']);
                                $landline_calling_code = (int) $landlineNumber[0];
                                $contacts['landline_calling_code'] =!empty($landlineNumber[1]) ?  $landline_calling_code : "";
                                $contacts['landline_number'] = !empty($landlineNumber[1]) ? (int) $landlineNumber[1] : "";
                            }
                        }
                        $checkMobileNumber = CustomersContact::where(['customer_id' => $id,"mobile_number" => $contacts['mobile_number']])->get();
                        if(empty($checkMobileNumber[0]['mobile_number']))//for new mobile number
                        {
                            $contacts['customer_id'] = $id;
                            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
                            $contacts = array_merge($contacts,$create);
                            CustomersContact::create($contacts); //insert data into customer_contacts table
                        }
                        else{//for existing mobile number
                            $contacts['updated_date'] =  date('Y-m-d', strtotime($contacts['created_date']));
                            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
                            $contacts = array_merge($contacts,$update);
                            $updateContact = CustomersContact::where('id',$contacts['id'])->update($contacts); //insert data into customer_contacts table
                       
                            if($updateContact == 1){
                                if(count($checkMobileNumber) == 0)
                                {
                                    $contacts['record_type'] = 1;
                                }
                                else{
                                    $getResult = array_diff_assoc($originalContactValues[$i]['attributes'], $contacts);
                                    $contacts['main_record_id'] = $originalContactValues[$i]['attributes']['id'];
                                    unset($getResult['created_date']);
                                    $implodeArr =  implode(",",array_keys($getResult));
                                    $contacts['record_type'] = 2;
                                    $contacts['column_names'] = $implodeArr;
                                }                        
                                $contacts['record_restore_status'] = 1;
                                CustomersContactsLog::create($contacts); //insert data into customer_contacts_logs table
                            }
                        }
                        $i++;                     
                    }
                }
            }
            catch (\Exception $ex) {
                $result = ["success" => false, "status" => 412, "message" => $ex->getMessage()];
                return json_encode($result);
            }
            $result = ["success" => true, "customerId" => $id];
            return json_encode($result);   
            
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
        
        public function getCustomerDetails()
	{
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata, true);            
            $customerMobileNo = !empty($request['data']['customerMobileNo']) ? $request['data']['customerMobileNo'] : "0";
            $customerEmailId = !empty($request['data']['customerEmailId']) ? $request['data']['customerEmailId'] : "0";
            $getCustomerContacts = DB::select('CALL proc_get_customer_contacts("'.$customerMobileNo.'","'.$customerEmailId.'")');
            
            if(count($getCustomerContacts) > 0)
            {
                $getCustomerPersonalDetails = Customer::where('id', '=', $getCustomerContacts[0]->customer_id)->get(); 
                $result = ['success' => true, 'customerPersonalDetails' => $getCustomerPersonalDetails ,'customerContactDetails' => $getCustomerContacts];
                return json_encode($result);
            }
            else{
                $result = ['success' => false, "message" => "No record found"];
                return json_encode($result);
            }
	}
        public function checkMobileExist()
        {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata, true);
            
            $mobileNumber = $request['data']['mobileNumber'];
            if (!empty($mobileNumber)) {
                $explodeMobileNumber = explode("-", $mobileNumber);          
                $mobileNumber = (int) $explodeMobileNumber[1];
            }
            $checkMobile = CustomersContact::select('customer_id','mobile_number')->where('mobile_number',$mobileNumber)->first();
            
            if (empty($checkMobile) || $checkMobile['customer_id'] == $request['data']['customerId']) {
                $result = ['success' => true];
            }else if (!empty($checkMobile)) { //Mobile number already exist
                $result = ['success' => false];
            }
            return json_encode($result);
        }
        public function showEnquiry($id)
        {
            $customer = Customer::select("id","first_name","last_name")->where("id",$id)->get();
            return view("MasterSales::enquiry")->with(["firstName"=> $customer[0]["first_name"],"lastName"=> $customer[0]["last_name"]]);
        }
}
