<?php

namespace App\Modules\Clients\Controllers;

error_reporting(0);

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ClientInfo;
use App\Models\ClientContactPerson;
use App\Models\SubscribedService;
use App\Models\MlstValueAddedService;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Discount;
use App\Models\AccInvoiceLog;
use App\Models\AccInvoice;
use App\Classes\S3;

class ClientsController extends Controller {

    public function __construct() {
        $this->middleware('web');
    }

    public function index() {
        return view("Clients::index");
    }

    public function manageClients() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        
        if (!empty($request['id']) && $request['id'] != 0) {
            $getClientLists = ClientInfo::where('id', $request['id'])->first();
            $contactInfo = ClientContactPerson::where('client_id', $request['id'])->get();

            if (!empty($getClientLists)) {
                $count = count($getClientLists);
                $result = ['success' => true, 'records' => $getClientLists, 'count' => $count, 'contactflag' => 1, 'contactinfo' => $contactInfo];
                return json_encode($result);
            } else {
                $result = ['success' => false, 'message' => 'Something went wrong', 'contactflag' => 0, 'count' => $count];
                return json_encode($result);
            }
        } else {
            $getClientLists = ClientInfo::select('client_infos.id as id', 'cg.id as client_group_id','cg.group_name as group_name','marketing_name', 'client_id', 'client_key', 'group_id', 'legal_name', 'website')->leftjoin('client_groups as cg','cg.id','=','client_infos.group_id')->get();
            if (!empty($getClientLists)) {
                $count = count($getClientLists);
                $result = ['success' => true, 'records' => $getClientLists, 'count' => $count];
                return json_encode($result);
            } else {
                $count = count($getClientLists);
                $result = ['success' => false, 'message' => 'Something went wrong', 'count' => $count];
                return json_encode($result);
            }
        }
    }

    public function manageClientinfowithservices() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        $client_id = $request['id'];
        if (!empty($request['id']) && $request['id'] != 0) {
            $getClientLists = ClientInfo::where('id', $request['id'])->first();
            $contactInfo = ClientContactPerson::where('client_id', $request['id'])->get();
                $serviceInfo = DB::table('subscribed_services')->select('vas.id as service_id','vas.hsn_sac', 'vas.service_name','subscribed_services.status','subscribed_services.id as id','subscribed_services.unit','subscribed_services.price','subscribed_services.pri','subscribed_services.pri_price')->leftjoin('laravel_developement_master_edynamics.mlst_value_added_services as vas', 'vas.id', '=', 'subscribed_services.service_id')->where('client_id', $request['id'])->get();

            if (!empty($getClientLists)) {
                $count = count($getClientLists);
                $result = ['success' => true, 'records' => $getClientLists, 'count' => $count, 'contactflag' => 1, 'contactinfo' => $contactInfo, 'serviceInfo' => $serviceInfo];
                return json_encode($result);
            } else {
                $result = ['success' => false, 'message' => 'Something went wrong', 'contactflag' => 0, 'count' => $count];
                return json_encode($result);
            }
        } else {

            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

    public function changeServiceStatus() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);


        if (!empty($request['id'])) {
            $val = $request['val'];
            SubscribedService::where('id', $request['id'])->update(['status' => $val]);
            $result = ['success' => true, "successMsg" => "Service Setting has been changed."];
            echo json_encode($result);
        } else {
            $result = ['success' => false, 'errorMsg' => 'Something went wrong. Please check internet connection or try again'];
            echo json_encode($result);
        }
    }

    public function getServiceanddiscount() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);

        if (!empty($request['serviceId'])) {

            $serviceId = $request['serviceId'];
            $getClientLists = ClientInfo::where('id', $request['clientId'])->first();
            $subscribedServices = SubscribedService::where('service_id', $serviceId)->first();

            $servicesDiscount = Discount::select('id', 'applicable_month', 'discount_amt', 'discount_for_id', 'status', 'subscribed_service_id')->where('subscribed_service_id', $serviceId)->get();
            if (empty($servicesDiscount)) {
                $servicesDiscount = '';
            }

            $result = ['success' => true, "subscribedServices" => $subscribedServices, "servicesDiscount" => $servicesDiscount, 'clients' => $getClientLists,];
            echo json_encode($result);
        } else {
            $result = ['success' => false, 'errorMsg' => 'Something went wrong. Please check internet connection or try again'];
            echo json_encode($result);
        }
    }

    public function getClientDetails() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        $getClientLists = ClientInfo::where('id', $request['clientId'])->first();
        $result = ['success' => true, 'clients' => $getClientLists,];
        echo json_encode($result);
    }

    public function getdiscountdetails() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);

        if (!empty($request['discountId'])) {
            $mlstdiscount = \App\Models\MlstDiscount::whereIn('id', $request['discountId'])->get();
            foreach ($mlstdiscount as $dis) {
                $data[$dis->id] = array('discount_name' => $dis->discount_name);
            }
            $i = 0;
            foreach ($request['discountdata'] as $disdata) {
                $request['discountdata'][$i]['discount_for'] = $data[$disdata['discount_for_id']]['discount_name'];
                $i++;
            }
            $result = ['success' => true, "mlstdiscount" => $data, 'discountdata' => $request['discountdata']];
            echo json_encode($result);
        } else {
            $result = ['success' => false, 'errorMsg' => 'Something went wrong. Please check internet connection or try again'];
            echo json_encode($result);
        }
    }

    public function getServicefrmMaster() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        $serviceId = $request['serviceId'];
        $masterServices = MlstValueAddedService::whereIn('id', $serviceId)->get();
        foreach ($masterServices as $services) {
            $servicename = $services->service_name;
            $invoiceData['service'][$services->id] = $services->service_name;
        }

        $result = ['success' => false, 'records' => $invoiceData];
        echo json_encode($result);
    }

    public function getClientfirmpartners() {


        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        $clientId = $request['clientId'];
        if (!empty($clientId)) {
            $client_info = \App\Models\ClientInfo::where('id', $clientId)->first();
            $client_url = $client_info->website;
            $ch = curl_init();
            $url = $client_url . "/api/Companies/getfirmspartners";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            echo $result;
        }
    }

    // process started to generate invoice

    public function getinvoicedetails() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);

        $invoice_id = $request['invoice_id'];
        if (!empty($invoice_id)) {
            $invoice_acc_log = AccInvoiceLog::where(['invoice_no' => $invoice_id])->orderBy('invoicefor', 'DESC')->get();
            $invoiceData['client_id'] = $invoice_acc_log[0]->client_id;
            $invoiceData['company_id'] = $invoice_acc_log[0]->company_id;
            $invoiceData['invoice_date'] = date('d-m-Y', strtotime($invoice_acc_log[0]->invoice_date));
            $invoiceData['from_date'] = date('d-m-Y', strtotime($invoice_acc_log[0]->from_date));
            $invoiceData['to_date'] = date('d-m-Y', strtotime($invoice_acc_log[0]->to_date));
            $result = ['success' => true, 'records' => $invoiceData];
            echo json_encode($result);
        } else {
            $invoiceData = ' ';
            $result = ['success' => false, 'records' => $invoiceData];
            echo json_encode($result);
        }
    }

    public function generateInvoice() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);


        if (!empty($request)) {
            foreach ($request['servicestype']['service'] as $key => $service) {
                if ($service == 'SMS') {
                    $request['generateData']['sms'] = $service;
                    $request['generateData']['sms_service_id'] = $key;
                }
                if ($service == 'G SUITE') {
                    $request['generateData']['gmail'] = $service;
                    $request['generateData']['gmail_service_id'] = $key;
                }
            }


            if (!empty($request['generateData']['sms'])) {
                $_POST['sms'] = $request['generateData']['sms'];
            } else {
                $_POST['sms'] = 0;
            }

            if (!empty($request['generateData']['gmail'])) {
                $_POST['gmail'] = $request['generateData']['gmail'];
            } else {
                $_POST['gmail'] = 0;
            }
            
            $_POST['client_id'] = $request['generateData']['client_id'];
            
            $clientData =  ClientInfo::select('id','website')->where('id',$_POST['client_id'])->where('deleted_status','0')->first();
           
            $client_url =  $clientData->website;
            $url = $client_url . "/api/Companies/getCompanyid";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, 0);
            $result = curl_exec($ch);
            curl_close($ch);
            
            
            if(is_numeric($result))
            $_POST['company_id'] = !empty($result) ? $result : 0;
            else
              $_POST['company_id'] = 0;  
            
       
            //$_POST['company_id'] = !empty($request['generateData']['company_id']) ? $request['generateData']['company_id'] : 0;

           
            $_POST['sms_service_id'] = !empty($request['generateData']['sms_service_id']) ? $request['generateData']['sms_service_id'] : 0;
            $_POST['gmail_service_id'] = !empty($request['generateData']['gmail_service_id']) ? $request['generateData']['gmail_service_id'] : 0;
            $_POST['cnt'] = 0;
            $_POST['start_date'] = date('Y-m-d', strtotime($request['generateData']['start_date']));
            $_POST['end_date'] = date('Y-m-d', strtotime($request['generateData']['end_date']));
            $_POST['invoice_date'] = date('Y-m-d', strtotime($request['generateData']['invoice_date']));




            if (($_POST['sms'] != '0' || $_POST['gmail'] != '0' ) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {

                $data = $_POST;

                $result = $this->generatemanualinvoice($data);

                if ($result == 0) {
                    $result = ["error" => false, 'message' => 'Service Not Available!'];
                    return json_encode($result);
                } elseif ($result == 1) {
                    $result = ["success" => true, 'message' => 'Invoice Generated Successfully.'];
                    return json_encode($result);
                } elseif ($result == 2 || $result == 3) {
                    $result = ["error" => false, 'message' => 'Invoice Already Generated For This Month!'];
                    return json_encode($result);
                } elseif ($result == 4) {
                    $result = ["error" => false, 'message' => 'SMS Service Invoice Already Generated For This Month!'];
                    return json_encode($result);
                } elseif ($result == 5) {
                    $result = ["error" => false, 'message' => 'Gmail Service Invoice Already Generated For This Month!'];
                    return json_encode($result);
                }
            }
        }
    }

    public function regenerateInvoice() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);

        $invoiceData = $request['invoiceData'];

        $invoice_id = $invoiceData['invoice_id'];
        $invoice_date = date('Y-m-d', strtotime($invoiceData['invoice_date']));
        $start_date = date('Y-m-d', strtotime($invoiceData['start_date']));
        $to_date = date('Y-m-d', strtotime($invoiceData['end_date']));
        $company_id = $invoiceData['company_id'];

        $invoice_acc_log = AccInvoiceLog::where(['invoice_no' => $invoice_id])->orderBy('invoicefor', 'DESC')->get();

        $cnt = $invoice_acc_log[0]->flag + 1;
        $client_id = $invoice_acc_log[0]->client_id;

        if (empty($invoice_date))
            $invoice_date = date('Y-m-d', strtotime($invoice_acc_log[0]->invoice_date));

        $gmail = 0;
        $sms = 0;

        foreach ($invoice_acc_log as $invoicelogs) {

            if ($invoicelogs->invoicefor == "G SUITE") {
                $masterServices = MlstValueAddedService::where('service_name', 'G SUITE')->first();
                $gmail = $masterServices->id;
            }
            if ($invoicelogs->invoicefor == "SMS") {
                $masterServices = MlstValueAddedService::where('service_name', 'SMS')->first();
                $sms = $masterServices->id;
            }

            if (empty($start_date))
                $start_date = $invoicelogs->from_date;

            if (empty($to_date))
                $to_date = $invoicelogs->to_date;

            $invoicelogs->flag = $cnt;
            $invoicelogs->save();
        }

        $_POST['sms_service_id'] = $sms;
        $_POST['gmail_service_id'] = $gmail;
        $_POST['gmail'] = $gmail;
        $_POST['sms'] = $sms;

        $_POST['start_date'] = $start_date;
        $_POST['end_date'] = $to_date;
        $_POST['cnt'] = $cnt;
        $_POST['client_id'] = $client_id;
        $_POST['invoice_id'] = $invoice_id;
        $_POST['invoice_date'] = $invoice_date;
        $_POST['company_id'] = !empty($company_id) ? $company_id : 0;
        $data = $_POST;
        $result = $this->generatemanualinvoice($data);
        if ($result == 0) {
            $result = ["error" => false, 'message' => 'Service Not Available!'];
            return json_encode($result);
        } elseif ($result == 1) {
            $result = ["success" => true, 'message' => 'Invoice Generated Successfully.'];
            return json_encode($result);
        } elseif ($result == 2 || $result == 3) {
            $result = ["error" => false, 'message' => 'Invoice Already Generated!'];
            return json_encode($result);
        } elseif ($result == 4) {
            $result = ["error" => false, 'message' => 'SMS Service Invoice Already Generated!'];
            return json_encode($result);
        } elseif ($result == 5) {
            $result = ["error" => false, 'message' => 'Gmail Service Invoice Already Generated!'];
            return json_encode($result);
        }
    }
    
    
    public function generatecroninvoice(){
        
        $data['invoice_date'] = date("Y-m-d", strtotime("first day of this month"));
        $data['start_date'] = date("Y-m-d", strtotime("first day of previous month"));
        $data['end_date'] = date("Y-m-d", strtotime("last day of previous month"));
        
        
        $clientData =  ClientInfo::select('id')->where('deleted_status','0')->get();
        foreach ($clientData as $client){
            $data['client_id'] = $client_id = $client->id;
            
            $client_url = $client->website;
            $url = $client_url . "/api/Companies/getCompanyid";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, 0);
            $result = curl_exec($ch);
            curl_close($ch);
            
            $data['company_id'] = $result;
            
            $services = SubscribedService::select('service_id')->where('client_id',$client_id)->get();
            foreach($services  as $serviceid){
                if($serviceid->service_id == 1){
                    $data['sms_service_id'] = 1;
                    $data['sms'] = 1;
                }
                
                if($serviceid->service_id == 2){
                   $data['gmail_service_id'] = 2;
                   $data['gmail'] = 2;
                }
                
                if($serviceid->service_id == 3){
                   $data['servicestype'][] = 3;
                }
                
            } 
             
            
           // for gmail and sms cron invoice
          if(!empty($data['sms_service_id']) || !empty($data['gmail_service_id']) )
                    $this->generatemanualinvoice($data);
           
           // for cloudtelephony cron invoice
            
//           $data['generateData']['invoice_date'] = $data['invoice_date'];
//           $data['generateData']['start_date'] = $data['start_date'];
//           $data['generateData']['end_date'] = $data['end_date'];
//           $data['clientId'] = $client_id;
//            if(!empty($data['servicestype']))
//              $this->generateCtInvoice($data);
          
        
          
          
        }
       
        
    }

    public function generatemanualinvoice($data) {

        if (!empty($data)) {

            $from_date = date("Y-m-d 00:00:00", strtotime($data['start_date']));
            $to_date = date("Y-m-d 23:59:59", strtotime($data['end_date']));
            $month = date('M Y', strtotime($data['start_date'])); //
            $client_id = $data['client_id'];
            $sms_service_id = !empty($data['sms_service_id']) ? $data['sms_service_id'] : 0;
            $gmail_service_id = !empty($data['gmail_service_id']) ? $data['gmail_service_id'] : 0;
            $regcnt = $_POST['cnt'];
            $invoice_id = !empty($_POST['invoice_id']) ? $_POST['invoice_id'] : "";

            $company_id = !empty($data['company_id']) ? $data['company_id'] : 0;

            if($data['invoice_date'])
            {
                 $invoice_date = $data['invoice_date'];
            }else
            {
                $invoice_date = $_POST['invoice_date'];
            }
            
            
            if (empty($invoice_id)) {
                $sms = "SMS";
                $email = "GSUITE";

 
        
                if (!empty($data['sms_service_id']) && !empty($data['gmail_service_id'])) {
                    //check already invoice generated or not 
                    $invoice_details = AccInvoiceLog::where(['client_id' => $client_id, 'from_date' => $from_date, 'to_date' => $to_date])
                                    ->whereIN('invoicefor', array($sms, $email))->get();


                    if(!empty($invoice_details)){
                        $cnt = count($invoice_details);

                        if ($cnt == 1) {
                            foreach ($invoice_details as $invoice) {
                                $service = $invoice->invoicefor;
                            }
                            if ($service == 'SMS') {
                                return 4;
                            } else {
                                return 5;
                            }
                        } elseif ($cnt == 2) {
                            return 3;
                        }
                    }
                } else if (!empty($data['sms_service_id'])) {
                    $sms = "SMS";
                    $invoice_details = AccInvoiceLog::where(['client_id' => $client_id, 'from_date' => $from_date, 'to_date' => $to_date, 'invoicefor' => $sms])->first();

                    if (!empty($invoice_details))
                        return 4;
                } else if (!empty($data['gmail_service_id'])) {
                    $gmail = "GSUITE";
                    $invoice_details = AccInvoiceLog::where(['client_id' => $client_id, 'from_date' => $from_date, 'to_date' => $to_date, 'invoicefor' => $gmail])->first();

                    if (!empty($invoice_details))
                        return 5;
                }
            } else {
                $invoice_data = AccInvoice::where(['invoice_id' => $invoice_id])->first();
            }



            if (!empty($data['gmail'])) {

                $available_services = SubscribedService::leftjoin('laravel_developement_master_edynamics.mlst_value_added_services as mvas', 'subscribed_services.service_id', '=', 'mvas.id')->where(['client_id' => $client_id, 'status' => 1, 'service_id' => $gmail_service_id])->first();

                if (!empty($available_services)) {
                    $gmail_quantity = $available_services->unit;


                    $amount = round($gmail_quantity * $available_services->price);

                    $discount_charges = Discount::leftjoin('laravel_developement_master_edynamics.mlst_discount as dis', 'discount.discount_for_id', '=', 'dis.id')->leftjoin('laravel_developement_master_edynamics.mlst_value_added_services as mvas', 'dis.value_added_services_id', '=', 'mvas.id')->where(['applicable_month' => $month, 'subscribed_service_id' => $available_services->id, 'client_id' => $client_id, 'status' => 1])->first();

                    if (empty($discount_charges)) {
                        $last_amount = $amount;
                        $discount = 0;
                        $discountfor = "";
                        $charge = 0;
                        $chargefor = "";
                    } else {
                        $discount = $discount_charges->discount_amt;
                        $charge = 0;
                        $discountfor = $discount_charges->discount_name;
                        $chargefor = 0;
                        $dis_amount = round($amount - $discount);
                        $last_amount = round($dis_amount + $charge);
                    }
                    /* service tax */
                    $total_service_tax = 9;
                    $servicetax1 = round($last_amount * $total_service_tax / 100);
                    $servicetax2 = round($last_amount * $total_service_tax / 100);
                    $servicetax = $servicetax1 + $servicetax2;
                    /* end */
                    //$servicetax = round($last_amount * ($total_service_tax / 100));

                    if (!empty($invoice_data)) {
                        $modelEmail = AccInvoiceLog::where(['invoice_no' => $invoice_data->invoice_id, 'invoicefor' => 'G SUITE'])->first();
                    } else {
                        $modelEmail = new AccInvoiceLog();
                    }
                    $modelEmail->company_id = $company_id;
                    $modelEmail->client_id = $client_id;
                    $modelEmail->invoice_date = $invoice_date;
                    $modelEmail->invoicefor = 'G SUITE';
                    $modelEmail->hsn_sac = $available_services->hsn_sac;
                    $modelEmail->sub_product_services = ''; //$available_services->sub_services;
                    $modelEmail->quantity = $gmail_quantity;
                    $modelEmail->from_date = $from_date;
                    $modelEmail->to_date = $to_date;
                    $modelEmail->rate = $available_services->price;
                    $modelEmail->discount = $discount;
                    $modelEmail->discount_for = $discountfor;
                    $modelEmail->charges = $charge;
                    $modelEmail->charges_for = $chargefor;
                    $modelEmail->amount = $amount;
                    $modelEmail->servicetax = $servicetax;
                    $modelEmail->created_date = date('Y-m-d');
                    $modelEmail->created_by = 1;//Auth::guard('admin')->user()->id;

                    $modelEmail->save();
                } else {
                    return 0;
                }
            } else {
                $modelEmail = "";
            }
            
            
            if (!empty($data['sms'])) {

                $available_services = SubscribedService::leftjoin('laravel_developement_master_edynamics.mlst_value_added_services as mvas', 'subscribed_services.service_id', '=', 'mvas.id')->where(['client_id' => $client_id, 'status' => 1, 'service_id' => $sms_service_id])->first();

              
                $client_info = \App\Models\ClientInfo::where('id', $client_id)->first();
                if (!empty($available_services)) {
                    $array = array("start_date" => $from_date, "end_date" => $to_date);
                    $array = json_encode($array);
                    $client_url = $client_info->website;
                    $url = $client_url . "/api/promotionalsms/getSmsQty";
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    $sms_quantity = $result;

                    $main_amount = round($sms_quantity * $available_services->price);


                    $discount_chargessms = Discount::leftjoin('laravel_developement_master_edynamics.mlst_discount as dis', 'discount.discount_for_id', '=', 'dis.id')->leftjoin('laravel_developement_master_edynamics.mlst_value_added_services as mvas', 'dis.value_added_services_id', '=', 'mvas.id')->where(['applicable_month' => $month, 'subscribed_service_id' => $available_services->id, 'client_id' => $client_id, 'status' => 1])->first();

                    if (empty($discount_chargessms)) {
                        $last_amountsms = $main_amount;
                        $discountsms = 0;
                        $discountforsms = "";
                        $chargesms = 0;
                        $chargeforsms = "";
                    } else {
                        $discountsms = $discount_chargessms->discount_amt;
//                        $chargesms = $discount_chargessms->charges;
                        $chargesms = 0;
                        $discountforsms = $discount_chargessms->discount_name;
//                        $chargeforsms = $discount_chargessms->charges_for;
                        $chargeforsms = 0;
                        $dis_amount = round($main_amount - $discountsms);
                        $last_amountsms = round($dis_amount + $chargesms);
                    }



                    /* service tax */
                    $total_service_tax = 9;
                    $servicetax1 = round($last_amountsms * $total_service_tax / 100);
                    $servicetax2 = round($last_amountsms * $total_service_tax / 100);
                    $servicetax = $servicetax1 + $servicetax2;
                    /* end */


                    if (!empty($invoice_data)) {
                        $modelSMS = AccInvoiceLog::where(['invoice_no' => $invoice_data->invoice_id, 'invoicefor' => 'SMS'])->first();
                    } else {
                        $modelSMS = new AccInvoiceLog();
                    }

                    $modelSMS->company_id = $company_id;
                    $modelSMS->client_id = $client_id;
                    $modelSMS->invoice_date = $invoice_date;
                    $modelSMS->invoicefor = 'SMS';
                    $modelSMS->hsn_sac = $available_services->hsn_sac;
                    $modelSMS->sub_product_services = $available_services->sub_services;
                    $modelSMS->quantity = $sms_quantity;
                    $modelSMS->from_date = $from_date;
                    $modelSMS->to_date = $to_date;
                    $modelSMS->rate = $available_services->price;
                    $modelSMS->discount = $discountsms;
                    $modelSMS->discount_for = $discountforsms;
                    $modelSMS->charges = $chargesms;
                    $modelSMS->charges_for = $chargeforsms;
                    $modelSMS->amount = $main_amount;
                    $modelSMS->servicetax = $servicetax;
                    $modelSMS->created_date = date('Y-m-d');
                    $modelSMS->created_by = 1;//Auth::guard('admin')->user()->id;

                    $modelSMS->save();
                } else {
                    return 0;
                }
            } else {
                $modelSMS = "";
            }


            if (!empty($last_amount) && !empty($last_amountsms)) {
                $last_amount = $last_amount + $last_amountsms;
            } else if (!empty($last_amount)) {
                $last_amount = $last_amount + 0;
            } else if (!empty($last_amountsms)) {
                $last_amount = $last_amountsms + 0;
            }


            if (empty($invoice_data)) {
                $obj = new AccInvoice();
                $obj->company_id = $company_id;

                $exitobj = AccInvoice::select('invoice_id')->orderBy('id', 'DESC')->first();

                if (empty($exitobj->invoice_id)) {
                    $obj->invoice_id = 1;
                } else {
                    $obj->invoice_id = $exitobj->invoice_id + 1;
                }
            } else {
                $obj = AccInvoice::where(['id' => $invoice_data->id])->first();
//                $obj->company_id = $obj->company_id;
//                $company_id = $obj->company_id;
            }

            $obj->client_id = $client_id;

            $obj->invoice_date = date('Y-m-d');
            $due_date = date('Y-m-d', strtotime($invoice_date . ' + 9 days'));
            $obj->due_date = $due_date;
            $obj->created_date = date('Y-m-d');
            $obj->created_by = 1;//Auth::guard('admin')->user()->id;
            $obj->save();

            $sr_no = $obj->invoice_id;
            $m = date('m', strtotime($obj->invoice_date));
            $date = $client_id . '/' . $m . '/';
            $invoiceno = $date . $sr_no;


            $Acc_invoice_row = AccInvoice::where(['id' => $obj->id])->first();

            $Acc_invoice_row->invoice_no = $invoiceno;
            $Acc_invoice_row->invoice_id = $sr_no;
            $Acc_invoice_row->total_amount = $last_amount;

            $Invoiceservicetax1 = round($last_amount * $total_service_tax / 100);
            $Invoiceservicetax2 = round($last_amount * $total_service_tax / 100);
            $Invoiceservicetax = $Invoiceservicetax1 + $Invoiceservicetax2;
            $Acc_invoice_row->servicetax_total = $Invoiceservicetax;
            $Acc_invoice_row->save();

            $final_invoice_ammount = round($Invoiceservicetax + $last_amount);
            $final_invoice_ammount = $this->numberTowords($final_invoice_ammount);

            $result = $this->generatePDF($modelEmail, $modelSMS, $client_id, $company_id, $invoiceno, $invoice_date, $regcnt, $final_invoice_ammount);

            return 1;
        }
    }

    public function generatePDF($modelEmail, $modelSMS, $client_id, $company_id, $invoiceno, $invoice_date, $count = 0, $final_invoice_ammount) {
       $uploads_dir = base_path() . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR;
      
        $clients = \App\Models\ClientInfo::where(['id' => $client_id])->first();
        if (!empty($company_id)) {
            // curl to get firm and partners detail from client database
            $array = array("company_id" => $company_id);
            $array = json_encode($array);
            $client_url = $clients->website;
            $url = $client_url . "/api/Companies/getfirmspartnerswithid";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
            $result = curl_exec($ch);
            curl_close($ch);
            $clients = json_decode($result);
        } else {
            $clients = \App\Models\ClientInfo::select('states.name as state_name', 'city.name as city_name', 'client_infos.*')->leftjoin('laravel_developement_master_edynamics.mlst_states as states', 'states.id', '=', 'client_infos.state_id')->leftjoin('laravel_developement_master_edynamics.mlst_cities as city', 'city.id', '=', 'client_infos.city_id')->where(['client_infos.id' => $client_id])->first();
        }

        
        $owndetails = \App\Models\ClientInfo::where(['id' => 1])->first();

        if (!empty($modelEmail) || !empty($modelSMS)) {
           
            if ($count > 0)
                $current_datetime = date('y-m-d H-i-s') . '-' . $count;
            else
                $current_datetime = date('y-m-d H-i-s');

            $marketing_name = $clients->marketing_name;
            
            echo 'her';
            $mPDF1 = new \mPDF('', '', 0, '', 8, 8, 8, 8, 8, 8, 'A4');
            
            $mPDF1->SetDisplayMode('fullpage');
            
            $view = \View::make('Clients::pdf', ['modelEmail' => $modelEmail, 'modelSMS' => $modelSMS, 'client' => $clients, 'owndetails' => $owndetails, 'invoiceno' => $invoiceno, 'invoice_date' => $invoice_date, 'final_invoice_ammount' => $final_invoice_ammount]);
            
            $contents = (string) $view;
           
            $contents = $view->render();
            
            $mPDF1->WriteHTML($contents);
 
           $file_name = "Invoicefor-$marketing_name-on-$current_datetime" . ".pdf";
           

            $file_name = str_replace(' ', '_', $file_name);


            $mPDF1->Output(base_path() . "/common/" . $file_name, "F");
            //$awsPath = 'invoices/' . $client_id;
            //$file_name = S3::s3FileUpload(base_path() . "/common/" . $file_name, $file_name, $awsPath);
            //unlink($uploads_dir . $file_name);


            $acc_invoice = AccInvoice::where(['client_id' => $client_id, 'invoice_no' => $invoiceno])->first();
            $service_type_id = 22;
            if (!empty($modelSMS)) {
                $modelSMS->invoice_no = $acc_invoice->invoice_id;
                $modelSMS->save();
                $bill_month = date('M Y', strtotime($modelSMS->from_date));
            }
            if (!empty($modelEmail)) {
                $modelEmail->invoice_no = $acc_invoice->invoice_id;
                $modelEmail->save();
                $bill_month = date('M Y', strtotime($modelEmail->from_date));
            }
            $invoice_for = 'Value added Services';

            $amount = $acc_invoice->total_amount;
            $totaltax = $acc_invoice->servicetax_total;
            $totalamount = $amount + $totaltax;

            $acc_invoice->invoice_file = $file_name;
            $acc_invoice->save();

            $due_date = date('Y-m-d', strtotime($invoice_date . ' + 9 days'));

            $array = array(
                'service_type_id' => $service_type_id,
                'invoice_no' => $invoiceno,
                'invoice_date' => $invoice_date,
                'invoice_amount' => $totalamount,
                'due_date' => $due_date,
                'bill_file_name' => $file_name,
                'bill_file_path' => $file_name,
                'bill_month' => $bill_month,
                'client_id' => $client_id,
                'invoice_for' => $invoice_for
            );


            $array = json_encode($array);
            $client_url = $clients->website;
            $url = $client_url . "/api/bills/sendInvoiceToClient";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
            $result = curl_exec($ch);
            curl_close($ch);

            return 1;
        } else {
            return 0;
        }
    }

    function numberTowords($number) {
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
            } else
                $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
                "." . $words[$point / 10] . " " .
                $words[$point = $point % 10] : '';
        return ucwords($result);
    }

    public function generateCtInvoice($request) {
        
        if(empty($request)){
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata, true);
        }
       
        $invoiceData = $request['generateData'];
        $clientId = $request['clientId'];
        $serviceId = $request['servicestype'][0];

        $invoice_date = date('Y-m-d', strtotime($invoiceData['invoice_date']));
        $start_date = date('Y-m-d', strtotime($invoiceData['start_date']));
        $to_date = date('Y-m-d', strtotime($invoiceData['end_date']));
        
        
        $clientData =  ClientInfo::select('id','website')->where('id',$clientId)->where('deleted_status','0')->first();
           
        $client_url =  $clientData->website;
        $url = $client_url . "/api/Companies/getCompanyid";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 0);
        $result = curl_exec($ch);
        curl_close($ch);
            
        $company_id = !empty($result) ? $result : 0;
          
            
        $month = date('M Y', strtotime($invoiceData['start_date']));
        $billmonth = date('F Y', strtotime($invoiceData['start_date']));

        //total numbers from ct_bill_settings table

        $total_numbers = \App\Models\CtBillingSetting::select('rent_amount', DB::raw('SUM((CASE WHEN number_status = 1 THEN 1 ELSE 0 END)) AS is_active'), DB::raw('SUM((CASE WHEN number_status = 2 THEN 1 ELSE 0 END)) AS is_freezed'), DB::raw('SUM((CASE WHEN number_status = 3 THEN 1 ELSE 0 END)) AS is_zerorental'), DB::raw('SUM((CASE WHEN number_status = 4 THEN 1 ELSE 0 END)) AS is_deactive'))->where('client_id', $clientId)->get();
        $billingsratesob = \App\Models\CtBillingSetting::select('rent_amount','incoming_pulse_rate', 'local_outbound_pulse_rate', 'isd_outbound_pulse_rate')->where('client_id', $clientId)->where('default_number', 1)->first();
        $billingsrates = \App\Models\CtBillingSetting::select('rent_amount','incoming_pulse_rate', 'local_outbound_pulse_rate', 'isd_outbound_pulse_rate')->where('client_id', $clientId)->where('default_number', 0)->first();
        $rentamount = $billingsrates->rent_amount;

        $activeNumbers = $total_numbers[0]->is_active;
        $freezedNumbers = $total_numbers[0]->is_freezed;
        $zerorentalNumbers = $total_numbers[0]->is_zerorental;
        $deactiveNumbers = $total_numbers[0]->is_deactive;
        $totnumbers = $activeNumbers + $freezedNumbers + $deactiveNumbers;

        if (!empty($activeNumbers))
            $Subtotalactive = $activeNumbers * $rentamount;
        else
            $Subtotalactive = 0;

        if (!empty($freezedNumbers))
            $Subtotalfreezed = $freezedNumbers * $rentamount;
        else
            $Subtotalfreezed = 0;

        if (!empty($zerorentalNumbers))
            $Subtotalzerorental = $zerorentalNumbers * 0;
        else
            $Subtotalzerorental = 0;

        
         
        $incoming_pulse_rate = ($billingsrates->incoming_pulse_rate)/100;
        $local_outbound_pulse_rate = ($billingsratesob->local_outbound_pulse_rate)/100;
        $isd_outbound_pulse_rate = ($billingsratesob->isd_outbound_pulse_rate)/100;
        
        // pri lines qty and rates 
        $prilines = SubscribedService::select('id', 'service_id', 'pri', 'pri_price')->where('client_id', $clientId)->where('service_id', $serviceId)->first();

        $noofPrilines = $prilines->pri;
        $priPrice = $prilines->pri_price;

        if (!empty($noofPrilines))
            $SubtotalPrilines = $noofPrilines * $priPrice;



        //get client domain and fetch the logs details from client database.
        $clients = \App\Models\ClientInfo::where(['id' => $clientId])->first();


        $array = array(
            'start_date' => $start_date,
            'to_date' => $to_date,
            'sttime' => '00:00:00',
            'ttime' => '23:59:59'
        );

        $array = json_encode($array);
        $client_url = $clients->website;
        $url = $client_url . "/api/cloudcallinglogs/getCtlogsInboundPulse";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
        $pulse = curl_exec($ch);
        curl_close($ch);
        $pulse = json_decode($pulse);

        if (!empty($pulse->inbound_pulse)) {
            $incommingPulse = $pulse->inbound_pulse;
            $SubtotalincommingPulse = $incommingPulse * $incoming_pulse_rate;
        } else {
            $incommingPulse = 0;
            $SubtotalincommingPulse = 0;
        }

        if (!empty($pulse->outbound_pulse)) {
            $outgoingPulse = $pulse->outbound_pulse;
            $SubtotaloutgoingPulse = $outgoingPulse * $local_outbound_pulse_rate;
        } else {
            $outgoingPulse = 0;
            $SubtotaloutgoingPulse = 0;
        }


        $allsubtotal = $SubtotaloutgoingPulse + $SubtotalincommingPulse + $SubtotalPrilines + $Subtotalzerorental + $Subtotalfreezed + $Subtotalactive;

        //get HSN_SAC from value added service
        
        $hsn = MlstValueAddedService::select('hsn_sac')->where('id',3)->first();
        $HSN = $hsn->hsn_sac;
        //check discount
        $discountDetails = Discount::leftjoin('laravel_developement_master_edynamics.mlst_discount as dis', 'discount.discount_for_id', '=', 'dis.id')->leftjoin('laravel_developement_master_edynamics.mlst_value_added_services as mvas', 'dis.value_added_services_id', '=', 'mvas.id')->where(['applicable_month' => $month, 'subscribed_service_id' => $prilines->service_id, 'client_id' => $clientId, 'status' => 1])->get();
        foreach ($discountDetails as $discount) {
            if (!empty($discount)) {
                $discountamt = $discount->discount_amt;
                $discountName = $discount->discount_name;

                //pri lines discount
                if ($discount->discount_for_id == 1) {
                    $pridiscount = $discountamt;
                    $pritotal = $SubtotalPrilines - $discountamt;
                }
                //outbound call discount
                if ($discount->discount_for_id == 2) {
                    $outboundiscount = $discountamt;
                    $outboundtotal = $SubtotalPrilines - $discountamt;
                }
            } else {
                $pridiscount = 0;
                $outboundiscount = 0;
                $pritotal = 0;
                $outboundtotal = 0;
                $discountamt = 0;
                $discountName = ' ';
            }
        }


        $bothdiscount = $pridiscount + $outboundiscount;

        $last_amount = $allsubtotal - $bothdiscount;

        $cgst = ($last_amount * 9) / 100;
        $sgst = ($last_amount * 9) / 100;
        $cgst = round($cgst, 2);
        $sgst = round($sgst, 2);

        //insert into acc invoice table
        $obj = new AccInvoice();
        $obj->client_id = $clientId;
        $obj->company_id = $company_id;

        // check existing invoice number
        $exitobj = AccInvoice::select('invoice_id')->orderBy('id', 'DESC')->first();

        if (empty($exitobj->invoice_id)) {
            $obj->invoice_id = 1;
        } else {
            $obj->invoice_id = $exitobj->invoice_id + 1;
        }

        $obj->invoice_date = date('Y-m-d');
        $due_date = date('Y-m-d', strtotime($invoice_date . ' + 9 days'));
        $obj->due_date = $due_date;
        $obj->created_date = date('Y-m-d');
        $obj->created_by = 1;//Auth::guard('admin')->user()->id;
        $obj->save();

        $sr_no = $obj->invoice_id;
        $m = date('m', strtotime($obj->invoice_date));
        $date = $clientId . '/' . $m . '/';
        $invoiceno = $date . $sr_no;


        $Acc_invoice_row = AccInvoice::where(['id' => $obj->id])->first();

        $Acc_invoice_row->invoice_no = $invoiceno;
        $Acc_invoice_row->invoice_id = $sr_no;
        $Acc_invoice_row->total_amount = $last_amount;
        $Invoiceservicetax = $cgst + $sgst;
        $Acc_invoice_row->servicetax_total = $Invoiceservicetax;
        $Acc_invoice_row->save();

        $final_invoice_ammount = round($Invoiceservicetax + $last_amount);
        $final_invoice_ammount_inword = $this->numberTowords($final_invoice_ammount);
        // generate PDF

        if (!empty($company_id)) {
            // curl to get firm and partners detail from client database
            $array = array("company_id" => $company_id);
            $array = json_encode($array);
            $client_url = $clients->website;
            $url = $client_url . "/api/Companies/getfirmspartnerswithid";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
            $result = curl_exec($ch);
            curl_close($ch);
            $clients = json_decode($result);
        } else {
            $clients = \App\Models\ClientInfo::select('states.name as state_name', 'city.name as city_name', 'client_infos.*')->leftjoin('laravel_developement_master_edynamics.mlst_states as states', 'states.id', '=', 'client_infos.state_id')->leftjoin('laravel_developement_master_edynamics.mlst_cities as city', 'city.id', '=', 'client_infos.city_id')->where(['client_infos.id' => $clientId])->first();
            
        }
        
        

        $owndetails = \App\Models\ClientInfo::where(['id' => 2])->first();

        
            
            if ($count > 0)
                $current_datetime = date('y-m-d H-i-s') . '-' . $count;
            else
                $current_datetime = date('y-m-d H-i-s');

            $marketing_name = $clients->marketing_name;

            $mPDF1 = new \mPDF('', '', 0, '', 8, 8, 8, 8, 8, 8, 'A4');
            $mPDF1->SetDisplayMode('fullpage');
            $view = \View::make('Clients::ctpdf', ['rentamount'=>$rentamount,'zerorentalNumbers' => $zerorentalNumbers, 'freezedNumbers' => $freezedNumbers, 'activeNumbers' => $activeNumbers,
                        'Subtotalactive' => $Subtotalactive, 'Subtotalfreezed' => $Subtotalfreezed, 'Subtotalzerorental' => $Subtotalzerorental,
                        'noofPrilines' => $noofPrilines, 'priPrice' => $priPrice, 'SubtotalPrilines' => $SubtotalPrilines,'pridiscount'=>$pridiscount,'pritotal'=>$pritotal,
                        'incommingPulse'=>$incommingPulse,'incoming_pulse_rate'=>$incoming_pulse_rate,'SubtotalincommingPulse'=>$SubtotalincommingPulse,
                        'outgoingPulse'=>$outgoingPulse,'local_outbound_pulse_rate'=>$local_outbound_pulse_rate,'SubtotaloutgoingPulse'=>$SubtotaloutgoingPulse,
                'client' => $clients, 'owndetails' => $owndetails, 'invoiceno' => $invoiceno, 'invoice_date' => $invoice_date,
                        'final_invoice_ammount_inword' => $final_invoice_ammount_inword, 'billmonth' => $billmonth,'HSN'=>$HSN,'last_amount'=>$last_amount,'cgst'=>$cgst,'sgst'=>$sgst]);
            $contents = (string) $view;
            $contents = $view->render();
            $mPDF1->WriteHTML($contents);

            $file_name = "Invoicefor-$marketing_name-on-$current_datetime" . ".pdf";

            $file_name = str_replace(' ', '_', $file_name);


            $mPDF1->Output(base_path() . "/common/" . $file_name, "F");
            //$awsPath = 'invoices/' . $client_id;
            //$file_name = S3::s3FileUpload(base_path() . "/common/" . $file_name, $file_name, $awsPath);
            //unlink($uploads_dir . $file_name);


            $acc_invoice = AccInvoice::where(['client_id' => $clientId, 'invoice_no' => $invoiceno])->first();
            $service_type_id = 21;
           
            $invoice_for = 'Cloudtelephony';
            
            $acc_invoice->invoice_file = $file_name;
         
            $due_date = date('Y-m-d', strtotime($invoice_date . ' + 9 days'));

            $array = array(
                'service_type_id' => $service_type_id,
                'invoice_no' => $invoiceno,
                'invoice_date' => $invoice_date,
                'invoice_amount' => $final_invoice_ammount,
                'due_date' => $due_date,
                'bill_file_name' => $file_name,
                'bill_file_path' => $file_name,
                'bill_month' => $month,
                'client_id' => $clientId,
                'invoice_for' => $invoice_for
            );


            $array = json_encode($array);
            
            $client_url = $clients->website;
            $url = $client_url . "/api/bills/sendInvoiceToClient";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
            $result = curl_exec($ch);
            curl_close($ch);

            $result = ["success" => true, 'message' => 'Invoice Generated Successfully.'];
            return json_encode($result);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view("Clients::create")->with("clientId", '0');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $request = Input::all();
        $model = new ClientInfo();
        return $model->createClientInfo($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    public function edit($id) {
        return view("Clients::create")->with("clientId", $id);
    }

    public function update($id) {
        $request = Input::all();
        $model = new ClientInfo();
        $model->updateClientInfo($request);
    }

    public function clientinfo($id) {
        return view("Clients::client_info")->with("clientId", $id);
    }

    public function addServiceView($id, $sid = 0) {
        return view("Clients::addservice")->with("clientId", $id)->with("serviceId", $sid);
    }

    // add master service.
    public function addmstservices() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);


        if (!empty($request['service_name'])) {
            $user_id = Auth::guard('admin')->user()->id;
            $mlstserviceData['Data']['service_name'] = $request['service_name']['service_name'];
            $mlstserviceData['Data']['hsn_sac'] = $request['service_name']['hsn_sac'];
            $mlstserviceData['Data']['created_by'] = $user_id;
            $mlstserviceData['Data']['created_date'] = date('Y-m-d');
            MlstValueAddedService::create($mlstserviceData['Data']);
            ;
            $result = ['success' => true, "successMsg" => "Service Added Successfully"];
            echo json_encode($result);
        } else {
            $result = ['success' => false, 'errorMsg' => 'Something went wrong. Please check internet connection or try again'];
            echo json_encode($result);
        }
    }

    public function createServices() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);

        $user_id = Auth::guard('admin')->user()->id;

        if (!empty($request['serviceData'])) {

            $existService = SubscribedService::where('service_id', $request['serviceData']['service_id'])
                    ->where('client_id',$request['serviceData']['clientid'])->first();
            if (!empty($existService)) {

                $serviceData['Data']['client_id'] = $request['serviceData']['clientid'];
                $serviceData['Data']['status'] = $request['serviceData']['status'];
                $serviceData['Data']['unit'] = empty($request['serviceData']['unit']) ? 0 : $request['serviceData']['unit'];
                $serviceData['Data']['price'] = empty($request['serviceData']['price']) ? 0 : $request['serviceData']['price'];
                $serviceData['Data']['pri'] = empty($request['serviceData']['pri']) ? 0 : $request['serviceData']['pri'];
                $serviceData['Data']['pri_price'] = empty($request['serviceData']['pri_price']) ? 0 : $request['serviceData']['pri_price'];
                $serviceData['Data']['created_by'] = $user_id;
                $serviceData['Data']['created_date'] = date('Y-m-d');
                $serviceUpdate = SubscribedService::where('service_id', $request['serviceData']['service_id'])->update($serviceData['Data']);


                if (!empty($request['discountInfo'])) {
                    $cnt = count($request['discountInfo']);
                    for ($i = 0; $i < $cnt; $i++) {
                        $applicable_month = trim(date('M Y', strtotime($request['discountInfo'][$i]['applicable_month'])));
                        $existDiscount = \App\Models\Discount::where('subscribed_service_id', $request['serviceData']['service_id'])->where('applicable_month', $applicable_month)->where('discount_for_id', $request['discountInfo'][$i]['discount_for_id'])->first();

                        if (!empty($existDiscount)) {
                            $discountdata['data']['client_id'] = $request['serviceData']['clientid'];
                            $discountdata['data']['discount_amt'] = $request['discountInfo'][$i]['discount_amt'];
                            $discountdata['data']['applicable_month'] = $applicable_month;
                            $discountdata['data']['discount_for_id'] = $request['discountInfo'][$i]['discount_for_id'];
                            $discountdata['data']['status'] = $request['discountInfo'][$i]['status'];
                            $discountdata['data']['created_by'] = $user_id;
                            $discountdata['data']['created_date'] = date('Y-m-d');
                            \App\Models\Discount::where('subscribed_service_id', $request['serviceData']['service_id'])->where('applicable_month', $applicable_month)->update($discountdata['data']);
                        } else {

                            $discountdata['data']['client_id'] = $request['serviceData']['clientid'];
                            $discountdata['data']['discount_amt'] = $request['discountInfo'][$i]['discount_amt'];
                            $discountdata['data']['applicable_month'] = $applicable_month;
                            $discountdata['data']['subscribed_service_id'] = $request['serviceData']['service_id'];
                            $discountdata['data']['discount_for_id'] = $request['discountInfo'][$i]['discount_for_id'];
                            $discountdata['data']['status'] = $request['discountInfo'][$i]['status'];
                            $discountdata['data']['created_by'] = $user_id;
                            $discountdata['data']['created_date'] = date('Y-m-d');
                            \App\Models\Discount::create($discountdata['data']);
                        }
                    }
                }

                $result = ['success' => true, "successMsg" => "Service Updated Successfully"];
                echo json_encode($result);
            } else {


                $serviceData['Data']['client_id'] = $request['serviceData']['clientid'];
                $serviceData['Data']['service_id'] = $request['serviceData']['service_id'];
                $serviceData['Data']['status'] = $request['serviceData']['status'];
                $serviceData['Data']['unit'] = empty($request['serviceData']['unit']) ? 0 : $request['serviceData']['unit'];
                $serviceData['Data']['price'] = empty($request['serviceData']['price']) ? 0 : $request['serviceData']['price'];
                $serviceData['Data']['pri'] = empty($request['serviceData']['pri']) ? 0 : $request['serviceData']['pri'];
                $serviceData['Data']['pri_price'] = empty($request['serviceData']['pri_price']) ? 0 : $request['serviceData']['pri_price'];
                $serviceData['Data']['created_by'] = $user_id;
                $serviceData['Data']['created_date'] = date('Y-m-d');
                SubscribedService::create($serviceData['Data']);

                if (!empty($request['discountInfo'])) {
                    $cnt = count($request['discountInfo']);
                    for ($i = 0; $i < $cnt; $i++) {
                        $discountdata['data']['client_id'] = $request['serviceData']['clientid'];
                        $discountdata['data']['discount_amt'] = $request['discountInfo'][$i]['discount_amt'];
                        $discountdata['data']['applicable_month'] = date('M Y', strtotime($request['discountInfo'][$i]['applicable_month']));
                        $discountdata['data']['subscribed_service_id'] = $request['serviceData']['service_id'];
                        $discountdata['data']['discount_for_id'] = $request['discountInfo'][$i]['discount_for_id'];
                        $discountdata['data']['status'] = $request['discountInfo'][$i]['status'];
                        $discountdata['data']['created_by'] = $user_id;
                        $discountdata['data']['created_date'] = date('Y-m-d');
                        \App\Models\Discount::create($discountdata['data']);
                    }
                }

                $result = ['success' => true, "successMsg" => "Service Added Successfully"];
                echo json_encode($result);
            }
        } else {
            $result = ['success' => false, 'errorMsg' => 'Something went wrong. Please check internet connection or try again'];
            echo json_encode($result);
        }
    }

    public function destroy($id) {
        //
    }

}
