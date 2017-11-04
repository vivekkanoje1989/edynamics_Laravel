<?php namespace App\Http\Controllers\backend\Auth;

use App\Models\backend\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use View;
use App\Classes\CommonFunctions;
use App\Models\EmployeesDevice;
use App\Models\SystemConfig;
class LoginController extends Controller {
    
    /*
      |----------------------------------login----------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public static function checkUserCredentials(){
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        $result = "";
        // dd($request);
        // $checkEmail = Employee::getRecords(["id","first_name","last_name","password","high_security_password","employee_status","employee_photo_file_name"], ["username" => $request['data']['mobileData']]);//(select attributes, where conditions)
        if(isset($request['data']['mobileData'])){
            $checkEmail = Employee::select("id","employee_id","first_name","last_name","password","high_security_password","employee_status","employee_photo_file_name")->where(["username" => $request['data']['mobileData']])->get(); //(select attributes, where conditions)
        }else{}
            
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        
        if(empty($request['data']['passwordData'])){      
            if(!empty($checkEmail[0]->id)){
                if($checkEmail[0]->employee_status == 2){
                    $result = ['success' => false,'message' => 'Your accout has been temporarly suspended.'];
                    return json_encode($result);
                }else if($checkEmail[0]->employee_status == 3){
                    $result = ['success' => false,'message' => 'Your accout has been permanantly suspended.'];
                    return json_encode($result);
                }
                /*if(!preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$userAgent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($userAgent,0,4)))
                {
                    $getMacAddress = CommonFunctions::getMacAddress();
                    $checkDevice = EmployeesDevice::select('device_mac')->whereRaw("FIND_IN_SET(".$checkEmail[0]->employee_id.",employee_id)")->where(["device_mac"=>$getMacAddress])->get();
                    if(empty($checkDevice[0]->device_mac))
                    {
                        $result = ['success' => false,'message' => 'You are not authorised to access the system on this machine'];
                        return json_encode($result);
                    }                
                } */
                $result = ['success' => true, "message" => ["fullName" => $checkEmail[0]->first_name." ".$checkEmail[0]->last_name],"photo"=>$checkEmail[0]->employee_photo_file_name];
            }
            else{
                $result = ['success' => false,'message' => 'Mobile does not exist!'];
            }
        }
        // elseif(empty($request['data']['securityPasswordData'])){   
        //     if (\Hash::check($request['data']['passwordData'], $checkEmail[0]->password)) {
        //         $result = ['success' => true, "message" => ["fullName" => $checkEmail[0]->first_name." ".$checkEmail[0]->last_name],"photo"=>$checkEmail[0]->employee_photo_file_name];                
        //     }else {
        //         $result = ['success' => false,'message' => 'Wrong Password!'];
        //     }
        // }
        // else{      
        //     if ($request['data']['securityPasswordData'] == $checkEmail[0]->high_security_password) {
        //         $result = ['success' => true, "message" => ["fullName" => $checkEmail[0]->first_name." ".$checkEmail[0]->last_name],"photo"=>$checkEmail[0]->employee_photo_file_name];                
        //     }else {
        //         $result = ['success' => false,'message' => 'Wrong Password!'];
        //     }
        // }
        return json_encode($result);
    }
    
    
    public function checkDomainExists(){
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        
        if(!empty($request['website_url'])){
            $websiteurl = "http://".$request['website_url'];
           
            $clientExists = \App\Models\ClientInfo::select('id','company_logo')->where('website',$websiteurl)->first();
          
            $client_logo = "";
            if(empty($clientExists)){
                $websiteurl = "https://".$request['website_url'];
                $clientExists = \App\Models\ClientInfo::select('id','company_logo')->where('website',$websiteurl)->first();
                
            }
            if(!empty($clientExists->id)){
                $client_logo = config('global.s3Path') . '/client/' . $clientExists->id . '/' . $clientExists->company_logo;
                        
                $result = ['success' => true,'client_id' => $clientExists->id,"client_logo" => $client_logo];
            }else{
            $result = ['success' => false,'message' => 'Please check domain & try again'];
        }
            
        }else{
            $result = ['success' => false,'message' => 'Please check domain & try again'];
        }
        return json_encode($result);
    }
    
    public function getSession(Request $request) {     
        if (Auth::guard('admin')->check()) {            
            $authUser = Auth()->guard('admin')->user();
            $result = ['success' => true, 'id' => $authUser->id, 'name' => $authUser->name, 'email' => $authUser->email];
        } else {
            $result = ['success' => false];
        }
        return $result;
    }

    public function getLoginForm() {
        if (Auth::guard('admin')->check()) {
            $id = Auth()->guard('admin')->user()->id;
            return view('layouts.backend.dashboard')->with('id', $id);
        } else {
            /*$getMacAddress = CommonFunctions::getMacAddress();
            $checkDevice = EmployeesDevice::getRecords(['device_mac'],["device_mac" => $getMacAddress]);
            if(!empty($checkDevice))
            {*/
                return view('backend.auth.login');
           /* }
            else
            {
                return View::make('layouts.backend.error500')->withSuccess('You are not authorised to access the system on this machine');
            }*/
        }
    }
    
    public function getToken(){
        return Session::token();
    }

    public function authenticate(Request $request) {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        $username = $request['username'];
        $password = $request['password'];        
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $checkUsername = Employee::select(["id","employee_id","employee_status"])->where(["username" => $username])->get();//(select attributes, where conditions)
        
        $empId = $checkUsername[0]->employee_id;
        $employee_status = $checkUsername[0]->employee_status;
        $platformType = 2;
        /*if(!preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$userAgent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($userAgent,0,4)))
        {
            $platformType = 1;
            $getMacAddress = CommonFunctions::getMacAddress();
            $checkDevice = EmployeesDevice::select('device_mac')->where(["employee_id" => $empId,"device_mac"=>$getMacAddress])->get();

            if(empty($checkDevice[0]->device_mac))
            {
                CommonFunctions::insertLoginLog($username, "", $empId, 1, 3, $platformType); //loginStatus = 1(login fail), loginFailureReason = 3(not authorised to access the system)
                $result = ['success' => false,'message' => 'You are not authorised to access the system on this machine'];
            }
        } */  
       
        if ($employee_status == 1 && auth()->guard('admin')->attempt(['username' => $username, 'password' => $password],true)) { //username => mobile
            \Session::set('loginWith', 'backend');            
            if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$userAgent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($userAgent,0,4)))
            {   
                $authkey = $request['authkey'];
                $affectedRows = Employee::where('id', '=', $empId)->update([
                'mobile_remember_token' => $authkey,'menu_change_status' => 0]);
            }
            CommonFunctions::insertLoginLog($username, $password, $empId, 2, 0, $platformType); //loginStatus = 2(login), loginFailureReason = 0
//            $session = SystemConfig::where('id',Auth()->guard('admin')->user()->id)->get();
//            session(['s3Path' => 'https://s3.'.$session[0]->region.'.amazonaws.com/'.$session[0]->aws_bucket_id.'/']);                
            $result = ['success' => true, 'message' => 'Successfully logged in', 'loggedInUserId' => $empId];
        } else {
            if ($employee_status === 2) {
                $loginFailureReason = 2;
                $message = 'Your account has been temporarily suspended.';
            } elseif ($employee_status == 3) {
                $loginFailureReason = 3;
                $message = 'Your account has been permanently suspended.';
            } else {
                $loginFailureReason = 1;
                $message = 'Invalid Login Credentials!';
            }
            CommonFunctions::insertLoginLog($username, $password, $empId, 1, $loginFailureReason, $platformType);//loginStatus = 1(login fail)
            $result = ['success' => false, 'message' => $message];
        }        
        return json_encode($result);
    }

    public function getLogout() {
        $empId = Auth()->guard('admin')->user()->id;
        $username = Auth()->guard('admin')->user()->username;
        $_SESSION =array();
        //$GLOBALS = array();
        CommonFunctions::insertLoginLog($username, "-", $empId, 3, 0, $platformType = 1);//loginStatus = 3(logout)
        Auth()->guard('admin')->logout();
        \Session::flush();
        $result = ['success' => true, 'message' => 'Successfully logged out'];
        echo json_encode($result);        
    }

    //Viveknk for setting timezone called from adminController.js
    public function setTimezone() 
    {
        $postdata = file_get_contents('php://input');
        $request = json_decode($postdata, true);

        $bfr = date_default_timezone_get();
        date_default_timezone_set($request['tmz']);
        $aftr = date_default_timezone_get();

        $result = ['success' => true, 'bfr' => $bfr, 'aftr' => $aftr,];			
        return json_encode($result);       
    }
    
}
