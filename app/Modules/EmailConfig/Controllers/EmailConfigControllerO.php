<?php

namespace App\Modules\EmailConfig\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\EmailConfig\Models\EmailConfiguration;
use Illuminate\Http\Request;
use App\Classes\CommonFunctions;
use App\Mail\emailconfig;
use Illuminate\Support\Facades\Mail;
use App\Models\MlstBmsbVertical;
use App\Modules\ManageDepartment\Models\MlstBmsbDepartment;
use Auth;
use DB;

class EmailConfigController extends Controller {

    public function index() {
        return view("EmailConfig::index");
    }

    public function manageEmails() {
        $postdata = file_get_contents("php://input");
        $input = json_decode($postdata, true);
        if ($input['id'] > 0) { //  update mail Configuration
            $getEmailConfigs = EmailConfiguration::where('id', $input['id'])->get();
            $arr = explode(',', $getEmailConfigs[0]['department_id']);
            $getDepartment = MlstBmsbDepartment::whereIn('id', $arr)->get();
        } else { // index mail configuration 
            $getEmailConfigs = EmailConfiguration::select('id', 'email', 'password','project_id', 'department_id', 'status')->get();
            $getEmailConfigsCount = $getEmailConfigs->count();
            foreach ($getEmailConfigs as $getEmailConfig) {
                $arr = explode(',', $getEmailConfig['department_id']);
                $getDepartment = '';
                $getDepartments = MlstBmsbDepartment::whereIn('id', $arr)->select('department_name')->get();
                foreach ($getDepartments as $getDepart) {
                    $getDepartment .= ',' . $getDepart['department_name'];
                }
                $getDepartment = trim($getDepartment, ',');
                $getEmailConfig['deptName'] = $getDepartment;
            }
        }

        if ($getEmailConfigs) {
            $result = ['success' => true, 'records' => $getEmailConfigs, 'totalCount' => $getEmailConfigsCount,'departments' => $getDepartment];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something Went Wrong'];
            return json_encode($result);
        }
    }

    public function testEmail() {
        $postdata = file_get_contents("php://input");
        $input = json_decode($postdata, true);
        $userName = $input['email'];
        $password = $input['password'];
        $mailBody = "Testing mail " . "<br><br>" . "Thank You!";
        $companyName = config('global.companyName');
        $subject = "Mail subject";
        $data = ['mailBody' => $mailBody, "fromEmail" => $userName, "fromName" => $companyName, "subject" => $subject, "to" => "uma@nextedgegroup.co.in", "cc" => "geeta@nextedgegroup.co.in"];
        $sentSuccessfully = CommonFunctions::sendMail($userName, $password, $data);
        if ($sentSuccessfully) {
            $result = ['success' => true, 'message' => 'Mail Sent Successfully.'];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Wrong Credentials.'];
            return json_encode($result);
        }
    }

    public function create() {
        //return view('EmailConfig::create')->with('id', 0);
        return view('EmailConfig::index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $postdata = file_get_contents("php://input");
        $input = json_decode($postdata, true);
        $userName = $input['emaildata']['email'];
        // echo "store<br>";dd($input['emailData']);
        // DB::connection()->enableQueryLog();
        // if(!empty($input['emaildata'])){
        //     $userName = $input['emaildata']['email'];
        //     $password = $input['emaildata']['password'];
        //     $mailBody = "Testing mail " . "<br><br>" . "Thank You!";
        //     $companyName = config('global.companyName');
        //     $subject = "Mail subject";
        //     $data = ['mailBody' => $mailBody, "fromEmail" => $userName, "fromName" => $companyName, "subject" => $subject, "to" => "uma@nextedgegroup.co.in", "cc" => "geeta@nextedgegroup.co.in"];
        //     $sentSuccessfully = CommonFunctions::sendMail($userName, $password, $data);
        //     if ($sentSuccessfully) {
        //         echo "sentSuccessfully<br>";exit;
        //         if (!empty($input['emaildata']['departmentid'])) {
        //             $input['emaildata']['department_id'] = $input['emaildata']['departmentid'];
        //         } else {
        //             $input['emaildata']['department_id'] = implode(',', array_map(function($el) {
        //                         return $el['id'];
        //                     }, $input['emaildata']['department_id']));
        //         }
        //         $loggedInUserId = Auth::guard('admin')->user()->id;                
        //         $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
        //         $input['emaildata'] = array_merge($input['emaildata'], $create);
        //         $createEmailConfig = EmailConfiguration::create($input['emaildata']);
        //         if ($createEmailConfig) {
        //             $result = ['success' => true, 'message' => 'Data saved successfully'];
        //             $result = ['success' => true, 'result' => $result, 'records' => $getClntRl, 'totalCount' => $getClntRlCount ];
        //             return json_encode($result);
        //         }
        //     } else {
        //         $result = ['success' => false, 'message' => 'Wrong email credentials'];
        //     }
        //     return json_encode($result);
        // }

        //Viveknk Store fn
        
        echo "userName<br>";dd($userName);exit;
        
        $cnt = EmailConfiguration::where(['email' => $input['emaildata']['email']])->where('deleted_status', '=', 0)->get()->count();
		dd( DB::getQueryLog());
		if ($cnt > 0) {
			$result = ['success' => false, 'errormsg' => 'Email already exists'];			
            return json_encode($result);
        } else {
			$loggedInUserId = Auth::guard('admin')->user()->id;			
            $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
            echo "store<br>";dd($create); exit;
            
            // $input['emailData'] = array_merge($request, $create);

            // echo "store<br>";dd($input['emailData']); exit;
        
			$result = EmailConfiguration::create($input['emailData']);			
			$getEmail = EmailConfiguration::select('id', 'client_id', 'project_id', 'department_id', 'email', 'password', 'status')->where('deleted_status', '=', 0)->get();
			$getEmailCount = $getEmail->count();
			$last_insertedId = EmailConfiguration::latest('id')->first();
            $result = ['success' => true, 'result' => $result, 'records' => $getEmail,'last_insertedId' => $last_insertedId, 'totalCount' => $getEmailCount ];
			return json_encode($result);				
        }


    }

    public function show($id) {
        //
    }

    public function edit($id) {
        return view('EmailConfig::update')->with('id', $id);
    }

    public function update($id) {
        $postdata = file_get_contents("php://input");
        $input = json_decode($postdata, true);
        
        if(!empty($input['emaildata'])){
            
            $getAccountDetails = EmailConfiguration::select("email","password")->where('id', $id)->get();
            echo $getAccountDetails[0]['email']."==".$getAccountDetails[0]['password'];
            if(($getAccountDetails[0]['email'] != $input['emaildata']['email']) || ($getAccountDetails[0]['password'] != $input['emaildata']['password']) ){
                $userName = $input['emaildata']['email'];
                $password = $input['emaildata']['password'];
                $mailBody = "Testing mail " . "<br><br>" . "Thank You!";
                $companyName = config('global.companyName');
                $subject = "Mail subject";
                $data = ['mailBody' => $mailBody, "fromEmail" => $userName, "fromName" => $companyName, "subject" => $subject, "to" => "uma@nextedgegroup.co.in", "cc" => "geeta@nextedgegroup.co.in"];
                $sentSuccessfully = CommonFunctions::sendMail($userName, $password, $data);
                if ($sentSuccessfully) {}
                else {
                    $result = ['success' => false, 'message' => 'Wrong email credentials'];
                }
            }            
            if (!empty($input['emaildata']['departmentid'])) {
                $input['emaildata']['department_id'] = $input['emaildata']['departmentid'];
            } else {
                $input['emaildata']['department_id'] = implode(',', array_map(function($el) {
                            return $el['id'];
                        }, $input['emaildata']['department_id']));
            }
            $loggedInUserId = Auth::guard('admin')->user()->id;                
            $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
            $input['emaildata'] = array_merge($input['emaildata'], $update);
            $updateEmailConfig = EmailConfiguration::where('id', $id)->update($input['emaildata']);
            if ($updateEmailConfig) {
                $result = ['success' => true, 'message' => 'Data updated successfully'];
            } 
            return json_encode($result);
        }
    }

    public function destroy($id) {
        
    }

    public function getDepartments() {
        $getDepartments = MlstBmsbDepartment::all();
        if (!empty($getDepartments)) {
            $result = ['success' => true, 'records' => $getDepartments];
            return $result;
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }
    
    public function getdeptsel() {
        $postdata = file_get_contents("php://input");
        $deptns = json_decode($postdata, true);

        $getDepartment = 'A';
        foreach ($deptns as $deptn) {
            $arr = explode(',', $deptn);
            $getDepartments = MlstBmsbDepartment::whereIn('department_name', $arr)->select('id','department_name')->get();            
        }
        return json_encode($getDepartments);
    }

}
