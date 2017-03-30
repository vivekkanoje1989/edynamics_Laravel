<?php namespace App\Modules\Clients\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ClientGroup;
use Illuminate\Http\Request;

class ClientGroupsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{    
            return view("Clients::client_groups_index");
	}
        
        /**
	 * Client Groups listing
	 *
	 * @return Response
	 */
        public function manageClientGroup()
        {
            $model = new ClientGroup();
            return $model->getlist();
        }        

        

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $postdata = file_get_contents('php://input');
            $request = json_decode($postdata, true);
            $model = new ClientGroup();
            return $model->process($request);    
            
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

	

}
