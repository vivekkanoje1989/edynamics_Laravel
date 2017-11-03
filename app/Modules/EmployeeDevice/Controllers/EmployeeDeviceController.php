<?php

namespace App\Modules\EmployeeDevice\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\EmployeeDevice\Models\EmployeesDevice;
use Illuminate\Http\Request;
use App\Models\backend\Employee;
use DB;
use Auth;
use Validator;
use App\Classes\CommonFunctions;

class EmployeeDeviceController extends Controller {

    public function index() {
        return view("EmployeeDevice::index");
    }

    public function manageDevice() {
        $postdata = file_get_contents("php://input");
        $input = json_decode($postdata, true);
        if ($input['id'] === 'index') { // index
            $data = EmployeesDevice::select('employee_id','device_mac','device_name','device_status','device_type','id')->get();
            foreach ($data as $deviceData) {
                $name = '';
                $arr = explode(',', $deviceData['employee_id']);
                $empnames = Employee::whereIn('id', $arr)->select('first_name', 'last_name')->get();
                foreach ($empnames as $empname) {
                    $name .= ',' . $empname['first_name'] . ' ' . $empname['last_name'];
                }
                $name = trim($name, ',');
                $deviceData['employee_id'] = $name;
            }
        }
        if ($input['id'] === 0) { // create
            $data = 1;
        }
        if ($input['id'] > 0) { // update
            $data = EmployeesDevice::where('id', $input['id'])->get();
            $arr = explode(',', $data[0]['employee_id']);
            $employees = Employee::whereIn('id', $arr)->select('id', 'first_name', 'last_name', 'designation_id')->get();
            $data[0]['employee_id'] = $employees;
        }
        if (!empty($data)) {
            $result = ['success' => true, 'records' => $data];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

    public function create() {
        return view('EmployeeDevice::createEmployeeDevice')->with('id', 0);
    }

    public function store() {
        $postdata = file_get_contents("php://input");
        $input = json_decode($postdata, true);
        $validationMessages = EmployeesDevice::validationMessages();
        $validationRules = EmployeesDevice::validationRules();
      
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        if (!preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $userAgent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($userAgent, 0, 4))) {
            $validator = Validator::make($input['data'], $validationRules, $validationMessages);
            if ($validator->fails()) {
                $result = ['success' => false, 'message' => $validator->messages()];
                return json_encode($result, true);
            }
        }
        if (!empty($input['data']['employee_id'])) {
            $input['data']['employee_id'] = implode(',', array_map(function($el) {
                        return $el['id'];
                    }, $input['data']['employee_id']));
        } else {
            $input['data']['employee_id'] = $input['data']['employee_id'];
        }
        if (!empty($input['data']['loggedInUserId'])) {
            $loggedInUserId = $input['userData']['loggedInUserId'];
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
        }
        $create = CommonFunctions::insertMainTableRecords($loggedInUserId);
        $input['data'] = array_merge($input['data'], $create);
        $createDevice = EmployeesDevice::create($input['data']);
        if ($createDevice) {
            $result = ['success' => true, 'message' => "Device added successfully."];
            return json_encode($result);
        } else {
            $result = ['success' => false, 'meassage' => "Something wents wrong"];
            return json_encode($result);
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return view('EmployeeDevice::createEmployeeDevice')->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $postdata = file_get_contents("php://input");
        $input = json_decode($postdata, true);
        $validationMessages = EmployeesDevice::validationMessages();
        $validationRules = EmployeesDevice::validationRules();
        $validator = Validator::make($input['data'], $validationRules, $validationMessages);
        if ($validator->fails()) {
            $result = ['success' => false, 'message' => $validator->messages()];
            echo json_encode($result);
            exit;
        }
        if (!empty($input['data']['employee_id'])) {
            $input['data']['employee_id'] = implode(',', array_map(function($el) {
                        return $el['id'];
                    }, $input['data']['employee_id']));
        } else {
            $input['data']['employee_id'] = $input['data']['employee_id'];
        }
        if (!empty($input['data']['loggedInUserId'])) {
            $loggedInUserId = $input['userData']['loggedInUserId'];
        } else {
            $loggedInUserId = Auth::guard('admin')->user()->id;
        }
        $update = CommonFunctions::updateMainTableRecords($loggedInUserId);
        $input['data'] = array_merge($input['data'], $update);
        $updateDevice = EmployeesDevice::where('id', $id)->update($input['data']);
        $result = ['success' => true, 'message' => "Device updated successfully."];
        return json_encode($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    public function getAllEmployeesList() {
        $getEmployees = Employee::select('id', 'first_name', 'last_name', 'designation_id')->get();
        if (!empty($getEmployees)) {
            $result = ['success' => true, 'records' => $getEmployees];
            return $result;
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong'];
            return json_encode($result);
        }
    }

}
