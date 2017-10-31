<?php namespace App\Modules\EmployeeSalaryslip\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use ZipArchive; //used for zip process viveknk
use File; // used for file read process viveknk
use App\Modules\EmployeeSalaryslip\Models\EmployeeSalaryslip;
use App\Classes\CommonFunctions;
use DB;
use Auth;
use App\Classes\S3;


class EmployeeSalaryslipController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("EmployeeSalaryslip::index");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
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

	/**
	 * uploadzip() uploads the zip file of salary slips.
	 * viveknk
	 */
	public function uploadzip()
	{	
		$input = Input::all();
		// $postdata = file_get_contents('php://input');
		// $request = json_decode($postdata, true);
		// dd(json_decode($input['extaData'])->option);
		// dd($input);
		// dd(json_decode($input['fileData']));
		// dd($request[0]['formdata']);
		// dd($input[0]->getClientOriginalName());		
		
		//dd($originalExt);
		$options = json_decode($input['extaData'])->option;
		$options = (string)$options;
		
		if($input[0]) {

			$originalName = $input[0]->getClientOriginalName();
			$originalPath = $input[0]->getPathName();
			$originalExt = $input[0]->getClientOriginalExtension();			

			$filename = $originalName;
			$source = $originalPath;
			$extension = $originalExt;

			//initialize data
			// $month = "September2017";
			$month = json_decode($input['extaData'])->month;
			$year = Date('Y');
			$heading_name = "Salary Slip";
			$type_of_payment = 1; //"monthly"
			// $remarks = "emloyee salaryslips";
			$remarks = json_decode($input['extaData'])->remark;
			$status = 1;

			if($options == "Bulk"){	
				// echo $options;			
				$continue = strtolower($extension) == 'zip' ? true : false;
				if(!$continue) {
					$message = "The file you are trying to upload is not a .zip file. Please try again.";
					return json_encode(['message' => $message, 'success' => false]);
				}else{
					// clean directory
					$directory = "Salaryslip";
					$cleanFolder = File::cleanDirectory($directory);

					$target_path = "$originalPath".$filename;  // change this to the correct site path
					if(move_uploaded_file($source, $target_path)) {
						$zip = new ZipArchive();
						$x = $zip->open($target_path);
						if ($x === true) {
							$zip->extractTo("Salaryslip/"); // change this to the correct site path
							$zip->close();
					
							unlink($target_path);
						}
						$message = "Your .zip file was uploaded and unpacked.";
					} else {	
						$message = "There was a problem with the upload. Please try again.";
					}

					//fetching new directory from unziped salaryslip folder
					$Newdirectory = File::directories($directory);
					// dd($Newdirectory);
					$getDirectory = '';
					foreach($Newdirectory as $a){				
						// $getDirectory = $a.'/';
						$getDirectory = $a;
					}
					// echo $getDirectory;
					// exit;
					//show all files inside directory
					// echo "directory = ". json_encode($directory);
					$files = File::allFiles($directory);
					$newSlips = [];
					$i = 0;
					foreach ($files as $file)
					{					
						// echo (string)$file, "\n";
						$n = explode("/",(string)$file);
						$newSlips[$i] = $n[2];			
						

						// $path = $getDirectory;
						$path = $getDirectory.'/'.$newSlips[$i];
						
						
						// if (File::isWritable($file))
						// {
						// 	echo "Yes. $file is writable.";
						// }
						// if (File::isWritable($path))
						// {
						// 	echo "Yes. $path is writable.";
						// }

						// if (File::isFile($file))
						// {
						// 	echo "Yep. It's a file.";
						// } 10000000 byte = 10MB 

						// $bytes = File::size($file);
						// echo $bytes;

						// dd($path);
						$s3FolderName = 'Employee-Salaryslips';
						$salryslipName = $newSlips[$i];
						// $salryslipName = $file;
						S3::s3FileUpload($path, $salryslipName, $s3FolderName);

						$i++;
					}			
					// print_r($newSlips);
					
					$empID = [];
					$j = 0;
					foreach ($newSlips as $newSlip)
					{
						$ids = explode("_",(string)$newSlip);
						$empID[$j] = $ids[0];
						$j++;
					}
					// print_r($empID);
					$count = 0;
					$msgText = "";
					foreach ($empID as $key => $value)
					{
						// echo "key".(string)$key, "\n";
						// echo "value".(string)$value, "\n";
						// echo "slip ".$newSlips[$key], "\n";				
						
						$salaryslipData['month'] = $month;
						$salaryslipData['year'] = $year;
						$salaryslipData['heading_name'] = $heading_name;
						$salaryslipData['type_of_payment'] = $type_of_payment;
						$salaryslipData['remarks'] = $remarks;
						$salaryslipData['status'] = $status;
						$salaryslipData['employee_id'] = $value;	
						$salaryslipData['salaryslip_docName'] = $newSlips[$key];	
						
						//check if file already exists
						
						$check = EmployeeSalaryslip::where(['employee_id' => $value, 'month' => $month])->get()->count();	
						if($check > 0){
							//update data

							// echo "record found of month".$salaryslipData['month']."of employee id". $salaryslipData['employee_id'];
							$loggedInUserId = Auth::guard('admin')->user()->id;
							$common = CommonFunctions::updateMainTableRecords($loggedInUserId);
							$update = array_merge($salaryslipData, $common);							
							$create['client_id'] = 1;//test client should be changed
							$results = EmployeeSalaryslip::where(['employee_id' => $value, 'month' => $month])->update($update);
							$msgText = "update";	
						}else{
							//insert data

							// echo "salaryslipData= ";
							// print_r($salaryslipData);
							// echo "\n";
							// dd($salaryslipData);
							//save salary slip as per employee_id
							$loggedInUserId = Auth::guard('admin')->user()->id;
							$common = CommonFunctions::insertMainTableRecords($loggedInUserId);
							$create = array_merge($salaryslipData, $common);							
							$create['client_id'] = 1;//test client should be changed
							$results = EmployeeSalaryslip::create($create);	
							$msgText = "Insert";
						}								
						
						if($results){
							$count = $count + 1;
						}else{
							$count = $count;
						}

					}
				}//bulk end

			}else if($options == "Individual"){
				// echo $options;			
				
				$continue = strtolower($extension) == 'pdf' ? true : false;
				if(!$continue) {					
					$message = "The file you are trying to upload is not a .pdf file. Please try again.";
					return json_encode(['message' => $message, 'success' => false]);
				}else{
					
					// dd($path);
					$s3FolderName = 'Employee-Salaryslips';
					// $salryslipName = $file;
					S3::s3FileUpload($originalPath, $filename, $s3FolderName);

					$ids = explode("_",(string)$filename);
					$empID = $ids[0];
					
					// print_r($empID);
					$count = 0;
					$msgText = "";			
						
						$salaryslipData['month'] = $month;
						$salaryslipData['year'] = $year;
						$salaryslipData['heading_name'] = $heading_name;
						$salaryslipData['type_of_payment'] = $type_of_payment;
						$salaryslipData['remarks'] = $remarks;
						$salaryslipData['status'] = $status;
						$salaryslipData['employee_id'] = $empID;	
						$salaryslipData['salaryslip_docName'] = (string)$filename;	
						// print_r($salaryslipData);
						//check if file already exists
						
						$check = EmployeeSalaryslip::where(['employee_id' => $empID, 'month' => $month])->get()->count();	
						if($check > 0){
							//update data

							// echo "record found of month".$salaryslipData['month']."of employee id". $salaryslipData['employee_id'];
							$loggedInUserId = Auth::guard('admin')->user()->id;
							$common = CommonFunctions::updateMainTableRecords($loggedInUserId);
							$update = array_merge($salaryslipData, $common);
							$create['client_id'] = 1;//test client should be changed
							$results = EmployeeSalaryslip::where(['employee_id' => $empID, 'month' => $month])->update($update);
							$msgText = "update";	
						}else{
							//insert data

							// echo "salaryslipData= ";
							// print_r($salaryslipData);
							// echo "\n";
							// dd($salaryslipData);
							//save salary slip as per employee_id
							$loggedInUserId = Auth::guard('admin')->user()->id;
							$common = CommonFunctions::insertMainTableRecords($loggedInUserId);
							$create = array_merge($salaryslipData, $common);
							$create['client_id'] = 1;//test client should be changed
							$results = EmployeeSalaryslip::create($create);	
							$msgText = "Insert";
						}								
						
						if($results){
							$count = $count + 1;
						}else{
							$count = $count;
						}

					
				}
			} // Individual end			

			if ($count > 0) {
				if($msgText == "Insert"){
					$message = 'Employee Salaryslip uploaded as per respective Employee Id';
				}else if($msgText == "update"){
					$message = 'Employee Salaryslip uploaded as per respective Employee Id and data Updated';					
				}
				$result = ['success' => true, 'message' => $message];
			} else {
				$result = ['success' => false, 'message' => 'Employee Salaryslips could not be upload'];
			}
			return json_encode($result);

		}
	}

	//Dashboard MY Salay Slips viveknk
	public function mysalaryslip() {		
		return view("EmployeeSalaryslip::mysalaryslip");
	}

	public function getMySalaryslips(){	
		$currenmnth = date('F');	
		// echo "curmnth--".$currenmnth;
		$loggedInUserId = Auth::guard('admin')->user()->id;		
		$getSlips = EmployeeSalaryslip::select('id', 'salaryslip_docName', 'month', 'year')->where(['employee_id' => $loggedInUserId])->get();		
		// $getSlips = EmployeeSalaryslip::select('id', 'employee_id', 'salaryslip_docName', 'month')->get();		
		// $getSlips = EmployeeSalaryslip::select('id', 'employee_id', 'salaryslip_docName', 'month')->orderBy('month', 'desc')->get();		
		// echo "<pre>";
		// print_r($getSlips->toArray());
		// echo "</pre>";
		
		// exit;
		$result = [ 'records' => $getSlips ];
		return json_encode($result);
	}

	//download employee salary slips of selected year
	public function downloadSalaryslipsZip(){
		$postdata = file_get_contents("php://input");
		$input = json_decode($postdata, true);
		// dd($input);
		$loggedInUserId = Auth::guard('admin')->user()->id;			
		$getSlips = EmployeeSalaryslip::select('id', 'salaryslip_docName', 'month', 'year')->where(['employee_id' => $loggedInUserId])->where(['year' => $input['year']])->get();		
		
		if($getSlips){

			$cln = "Salaryslip/";
			$cleanFolder = File::cleanDirectory($cln);//viveknk clean folder to avoid wrong files

			$public_dir= "Salaryslip";
			
			$zipFileName = $loggedInUserId.'_salaryslip.zip';


			$salaryslipName = [];
			$i = 0;
			$notfoundfile = []; 
			foreach ($getSlips as $slips)
			{
				$salaryslipName[$i] = $slips['salaryslip_docName'];			
				$filename = $salaryslipName[$i];
				// $dwfrom = 'https://storage.googleapis.com/edynamicsdevelopment/Employee-Salaryslips/'.$filename;	
				$dwfrom =  config('global.s3Path').'/Employee-Salaryslips/'.$filename;
				 
				$contents = file_get_contents($dwfrom);//store content of remote file to local storage
				if($contents){
					$file = 'Salaryslip/'.$filename;
					File::put($file, $contents);				
				}else{
					continue;
				}
				$i++;
			}

			//ziparchive to create zip file of downloaded files
			$zip = new ZipArchive;

			if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {  
								
				$salaryslipName2 = [];
				$j = 0;
				foreach ($getSlips as $slips)
				{
					$salaryslipName2[$j] = $slips['salaryslip_docName'];			
					$filename2 = $salaryslipName2[$j];
					$pathfrom = 'Salaryslip/'.$filename2;
					$zip->addFile($pathfrom, $filename2);
					$j++;
				}				
				$zip->close();//closes opened zip file
			}
			//set header for content-type
			$headers = array(
                'Content-Type' => 'application/octet-stream',
			);
			
			$filetopath = $public_dir.'/'.$zipFileName;		
			
			if(file_exists($filetopath)){				
				response()->download($filetopath,$zipFileName,$headers);
				$result = [ 'success' => true, 'message' => 'File generated.' ];
				return json_encode($result);
			}else{				
				$result = [ 'success' => false, 'message' => 'File does not exist.' ];
				return json_encode($result);
			}
		}else{
			$result = [ 'success' => false, 'message' => 'Something went wrong.' ];
			return json_encode($result);
		}
	}

}
