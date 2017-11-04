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
use Excel;

class EmailConfigController extends Controller {

    public function index() {
        return view("EmailConfig::index");
    }

    // public function manageEmails() {
    //     $postdata = file_get_contents("php://input");
    //     $input = json_decode($postdata, true);
    //     if ($input['id'] > 0) { //  update mail Configuration
    //         $getEmailConfigs = EmailConfiguration::where('id', $input['id'])->get();
    //         $arr = explode(',', $getEmailConfigs[0]['department_id']);
    //         $getDepartment = MlstBmsbDepartment::whereIn('id', $arr)->get();
    //     } else { // index mail configuration 
    //         $getEmailConfigs = EmailConfiguration::select('id', 'email', 'password','project_id', 'department_id', 'status')->get();
    //         $getEmailConfigsCount = $getEmailConfigs->count();
    //         foreach ($getEmailConfigs as $getEmailConfig) {
    //             $arr = explode(',', $getEmailConfig['department_id']);
    //             $getDepartment = '';
    //             $getDepartments = MlstBmsbDepartment::whereIn('id', $arr)->select('department_name')->get();
    //             foreach ($getDepartments as $getDepart) {
    //                 $getDepartment .= ',' . $getDepart['department_name'];
    //             }
    //             $getDepartment = trim($getDepartment, ',');
    //             $getEmailConfig['deptName'] = $getDepartment;
    //         }
    //     }

    //     if ($getEmailConfigs) {
    //         $result = ['success' => true, 'records' => $getEmailConfigs, 'totalCount' => $getEmailConfigsCount,'departments' => $getDepartment];
    //         return json_encode($result);
    //     } else {
    //         $result = ['success' => false, 'message' => 'Something Went Wrong'];
    //         return json_encode($result);
    //     }
    // }

    public function manageEmails() {
        $postdata = file_get_contents("php://input");
        $input = json_decode($postdata, true);
        
        $getEmailConfigs = EmailConfiguration::select('id', 'email', 'password','project_id', 'department_id', 'status')->where('deleted_status', '=', 0)->get();
        $getEmailConfigsCount = $getEmailConfigs->count();
        if ($getEmailConfigs) {
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

            // echo "getEmailConfigs = "; dd($getEmailConfigs->toArray());
        
            $result = ['success' => true, 'records' => $getEmailConfigs, 'totalCount' => $getEmailConfigsCount,'departments' => $getDepartment];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something Went Wrong'];
            return json_encode($result);
        }
    }

    public function testEmail() {
        // echo "testEmail"; exit;
        $postdata = file_get_contents("php://input");
        $input = json_decode($postdata, true);
        $userName = $input['emaildata']['email'];
        $password = $input['emaildata']['password'];
        // $userName = "vivekkanoje1989@gmail.com";
        // $password = "Vnk@8989";
        $mailBody = "Testing mail " . "<br><br>" . "Thank You!";
        $companyName = config('global.companyName');
        $subject = "Mail subject";
        $data = ['mailBody' => $mailBody, "fromEmail" => $userName, "fromName" => $companyName, "subject" => $subject, "to" => "vivekn@nextedgegroup.co.in", "cc" => "vivekkanoje89@gmail.com"];
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
         //Viveknk Store fn
        $postdata = file_get_contents("php://input");
        $requestData = json_decode($postdata, true);
        $userName = $requestData['emailData']['email']; 
       
        $cnt = EmailConfiguration::where('email', $userName )->where('deleted_status', '=', 0)->get()->count();
            
        if ($cnt > 0) {
            $result = ['success' => false, 'errormsg' => 'Email already exists'];			
            return json_encode($result);
        } else {

            //check mail credentials
            $userName = $requestData['emailData']['email'];
            $password = $requestData['emailData']['password'];
            $mailBody = "Hello! User, " . "<br><br> Welcome to Edynamics" ."<br>"."Your Email account<h4> ".$userName." <h4>configured successfuly.<br><br>". "Thank You!";
            $companyName = config('global.companyName');
            $subject = "Welcome to Edynamics";
            $data = ['mailBody' => $mailBody, "fromEmail" => $userName, "fromName" => $companyName, "subject" => $subject, "to" => "vivekn@nextedgegroup.co.in", "cc" => "vivekkanoje89@gmail.com"];
            $sentSuccessfully = CommonFunctions::sendMail($userName, $password, $data);           
            
            if($sentSuccessfully){
                $loggedInUserId = Auth::guard('admin')->user()->id;			
                $create = CommonFunctions::insertMainTableRecords($loggedInUserId);           
                // $input['emailDt'] = array_merge($requestData, $create);
                $getDepartmentID = '';
                foreach ($requestData['emailData']['department_id'] as $getDepart) {
                    $getDepartmentID .= ',' . $getDepart['id'];
                }
                $getDepartmentID = trim($getDepartmentID, ',');
                    
                $requestData['emailData']['department_id'] = $getDepartmentID;
                $input['emailDt'] = array_merge($requestData['emailData'], $create);          
                //storing data
                $result = EmailConfiguration::create($input['emailDt']); 
                $last_insertedId = EmailConfiguration::latest('id')->first();
                
                //getting all records 
                $getEmailConfigs = EmailConfiguration::select('id', 'email', 'password','project_id', 'department_id', 'status')->where('deleted_status', '=', 0)->get();
                $getEmailConfigsCount = $getEmailConfigs->count();
                if ($getEmailConfigs) {
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
                    // echo "getEmailConfigs = "; dd($getEmailConfigs->toArray());
                    $result = ['success' => true, 'records' => $getEmailConfigs, 'totalCount' => $getEmailConfigsCount,'departments' => $getDepartment,'last_insertedId' => $last_insertedId ];
                    return json_encode($result);
                }			
            }else{
                $result = ['success' => false, 'errormsg' => 'Wrong Credentials.'];
                return json_encode($result);
            } //end checkmail                
        }        
    }

    public function show($id) {
      
        //
    }

    public function edit($id) {
        return view('EmailConfig::update')->with('id', $id);
    }

    // public function update($id) {
    //     $postdata = file_get_contents("php://input");
    //     $input = json_decode($postdata, true);
        
    //     if(!empty($input['emaildata'])){
            
    //         $getAccountDetails = EmailConfiguration::select("email","password")->where('id', $id)->get();
    //         echo $getAccountDetails[0]['email']."==".$getAccountDetails[0]['password'];
    //         if(($getAccountDetails[0]['email'] != $input['emaildata']['email']) || ($getAccountDetails[0]['password'] != $input['emaildata']['password']) ){
    //             $userName = $input['emaildata']['email'];
    //             $password = $input['emaildata']['password'];
    //             $mailBody = "Testing mail " . "<br><br>" . "Thank You!";
    //             $companyName = config('global.companyName');
    //             $subject = "Mail subject";
    //             $data = ['mailBody' => $mailBody, "fromEmail" => $userName, "fromName" => $companyName, "subject" => $subject, "to" => "vivekn@nextedgegroup.co.in", "cc" => "vivekn@nextedgegroup.co.in"];
    //             $sentSuccessfully = CommonFunctions::sendMail($userName, $password, $data);
    //             if ($sentSuccessfully) {}
    //             else {
    //                 $result = ['success' => false, 'message' => 'Wrong email credentials'];
    //             }
    //         }            
    //         if (!empty($input['emaildata']['departmentid'])) {
    //             $input['emaildata']['department_id'] = $input['emaildata']['departmentid'];
    //         } else {
    //             $input['emaildata']['department_id'] = implode(',', array_map(function($el) {
    //                         return $el['id'];
    //                     }, $input['emaildata']['department_id']));
    //         }
    //         $loggedInUserId = Auth::guard('admin')->user()->id;                
    //         $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
    //         $input['emaildata'] = array_merge($input['emaildata'], $update);
    //         $updateEmailConfig = EmailConfiguration::where('id', $id)->update($input['emaildata']);
    //         if ($updateEmailConfig) {
    //             $result = ['success' => true, 'message' => 'Data updated successfully'];
    //         } 
    //         return json_encode($result);
    //     }
    // }


    public function update($id) {
        //Viveknk update fn
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        $userName = $request['emailData']['email']; 
        
        $cnt = EmailConfiguration::where('email', $userName )->where('id', "!=", $id )->where('deleted_status', '=', 0)->get()->count();
       
		if ($cnt > 0) {
			$result = ['success' => false, 'errormsg' => 'Email already exists'];			
            return json_encode($result);
        } else {
            //check mail credentials
            $userName = $request['emailData']['email'];
            $password = $request['emailData']['password'];
            $mailBody = "Hello! User, " . "<br><br> Welcome to Edynamics" ."<br>"."Your Email account<h4> ".$userName." </h4>updated successfuly.<br><br>". "Thank You!";
            $companyName = config('global.companyName');
            $subject = "Welcome to Edynamics";
            $data = ['mailBody' => $mailBody, "fromEmail" => $userName, "fromName" => $companyName, "subject" => $subject, "to" => "vivekkanoje1989@gmail.com", "cc" => "vivekkanoje89@gmail.com"];
            $sentSuccessfully = CommonFunctions::sendMail($userName, $password, $data);           
            
            if($sentSuccessfully){
                $loggedInUserId = Auth::guard('admin')->user()->id;			
                $update = CommonFunctions::updateMainTableRecords($loggedInUserId);           
                // $input['emailDt'] = array_merge($request, $create);
                $getDepartmentID = '';
                foreach ($request['emailData']['department_id'] as $getDepart) {
                    $getDepartmentID .= ',' . $getDepart['id'];
                }
                $getDepartmentID = trim($getDepartmentID, ',');
                
                $request['emailData']['department_id'] = $getDepartmentID;
                $input['emailDt'] = array_merge($request['emailData'], $update);          
                //update data
                $result = EmailConfiguration::where('id', $id)->update($input['emailDt']); 
                $last_insertedId = EmailConfiguration::latest('id')->first();
                
                //getting all records 
                $getEmailConfigs = EmailConfiguration::select('id', 'email', 'password','project_id', 'department_id', 'status')->where('deleted_status', '=', 0)->get();
                $getEmailConfigsCount = $getEmailConfigs->count();
                if ($getEmailConfigs) {
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
        
                    // echo "getEmailConfigs = "; dd($getEmailConfigs->toArray());
                
                    $result = ['success' => true, 'records' => $getEmailConfigs, 'totalCount' => $getEmailConfigsCount,'departments' => $getDepartment,'last_insertedId' => $last_insertedId ];
                    return json_encode($result);
                }
            }else{
                $result = ['success' => false, 'errormsg' => 'Wrong Credentials.'];
                return json_encode($result);
            } //end checkmail    			
        }
    }

    public function destroy($id) {
        //Viveknk delete fn
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        
        $getEmail = EmailConfiguration::where('id', $id )->where('deleted_status', '=', 0)->get();        
        $cnt = $getEmail->count();
       
		if ($cnt < 0) {
			$result = ['success' => false, 'errormsg' => 'Email can not be deleted.'];			
            return json_encode($result);
        } else {
            //check mail credentials
            $userName = $getEmail[0]['email'];
            $password = $getEmail[0]['password'];
            $mailBody = "Hello! User, " . "<br><br> Happy to serve you again" ."<br>"."Your Email account<h4> ".$userName." </h4>deleted successfuly.<br><br>". "Thank You!<br><br>  With Regards,<br>Edynamics";
            $companyName = config('global.companyName');
            $subject = "Welcome to Edynamics";
            $data = ['mailBody' => $mailBody, "fromEmail" => $userName, "fromName" => $companyName, "subject" => $subject, "to" => "vivekkanoje1989@gmail.com", "cc" => "vivekkanoje89@gmail.com"];
            $sentSuccessfully = CommonFunctions::sendMail($userName, $password, $data);           
            
            if($sentSuccessfully){
                $loggedInUserId = Auth::guard('admin')->user()->id;			
                $delete = CommonFunctions::deleteMainTableRecords($loggedInUserId);           
                        
                //update delete
                $result = EmailConfiguration::where('id', $id)->update($delete); 
                $last_insertedId = EmailConfiguration::latest('id')->first();
                
                //getting all records 
                $getEmailConfigs = EmailConfiguration::select('id', 'email', 'password','project_id', 'department_id', 'status')->where('deleted_status', '=', 0)->get();
                $getEmailConfigsCount = $getEmailConfigs->count();
                if ($getEmailConfigs) {
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
        
                    // echo "getEmailConfigs = "; dd($getEmailConfigs->toArray());
                
                    $result = ['success' => true, 'records' => $getEmailConfigs, 'totalCount' => $getEmailConfigsCount,'departments' => $getDepartment,'last_insertedId' => $last_insertedId ];
                    return json_encode($result);
                }
            }else{
                $result = ['success' => false, 'errormsg' => 'Wrong Credentials.'];
                return json_encode($result);
            } //end checkmail 			
        }
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

    //function to export data to xls
	public function exportToxls(){
		//echo "exportToxls";exit; 
        $getEmailConfigs = EmailConfiguration::select('id', 'email', 'password','project_id', 'department_id', 'status')->where('deleted_status', '=', 0)->get();
        $getEmailConfigsCount = $getEmailConfigs->count();
        if ($getEmailConfigsCount < 1) {          
			 return false;			 
        } else {
			//export to excel
			Excel::create('Configure Email Account', function($excel) use($getEmailConfigs){
				$excel->sheet('Email', function($sheet) use($getEmailConfigs){
					$sheet->fromArray($getEmailConfigs);
				});
			})->export('xlsx');				
		}				
	}

}
