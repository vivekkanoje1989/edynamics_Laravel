<?php namespace App\Modules\Clients\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ClientInfo;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ClientsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("Clients::index");
	}

        
        public function manageClients()
        {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata, true);
            $model = new ClientInfo();
            return $model->getlist($request);
        }
        
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return view("Clients::create")->with("clientId", '0');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
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
            return view("Clients::create")->with("clientId", $id);
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
