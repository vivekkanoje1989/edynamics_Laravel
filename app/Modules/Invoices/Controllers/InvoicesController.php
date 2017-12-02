<?php namespace App\Modules\Invoices\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AccInvoice;
use App\Models\ClientInfo;

use Illuminate\Http\Request;

class InvoicesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		return view("Invoices::invoicelist")->with("clientId", $id);
	}
        
        
    
    public function manageClientInvoices(){
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        
        if (!empty($request['client_id']) && $request['client_id'] != 0) {

            $getClientinvoiceLists = AccInvoice::where('client_id', $request['client_id'])->orderBy('id','DESC')->get();
            $getClientinfo =    ClientInfo::select('marketing_name')->where('id', $request['client_id'])->first();
            $count = 0;
            if (!empty($getClientinvoiceLists)) {
                $count = count($getClientinvoiceLists);
                $result = ['success' => true, 'records' => $getClientinvoiceLists, 'count' => $count, 'clientName' => $getClientinfo->marketing_name];
                return json_encode($result);
            } else {
                $result = ['success' => false, 'message' => 'Something went wrong', 'count' => $count];
                return json_encode($result);
            }
        } else {
            $result = ['success' => false, 'message' => 'Something went wrong', 'count' => $count];
            return json_encode($result);
        }
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

}
