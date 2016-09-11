<?php namespace App\Modules\CoxTable\App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Frameworks
use File;
use Auth;
use Validator;
use DB;
use Config;

// Helpers
use App\Modules\CoxTable\App\CoxTableHelpers as ModuleHelpers;

// Models
use App\Modules\CoxTable\App\Models\CoxTable;
use App\Modules\CoxTable\App\Models\CoxTableModuleSetting;


use App\Http\Controllers\AdminTemplateController;
class CoxTableAdminController extends AdminTemplateController {

	public $headName = "CoxTable";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datas = CoxTable::orderBy('id', 'desc')->get();
		return view("CoxTable::admin.".$this->theme.".index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view("CoxTable::admin.".$this->theme.".create")
		->with('headName', $this->headName);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "create")
		{
			$rules = array(
				// variables
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
                return back();
            }

            $data = CoxTable::create([
            	// variables
            ]);

            return redirect("admin/modules/CoxTable");
		}

		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = CoxTable::find($id);
		if($data != null)
		{
			return view("CoxTable::admin.".$this->theme.".show")
			->with('id', $id)
			->with('data', $data)
			->with('headName', $this->headName);
		}
		return back();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = CoxTable::find($id);
		if($data != null)
		{
			return view("CoxTable::admin.".$this->theme.".edit")
			->with('id', $id)
			->with('data', $data)
			->with('headName', $this->headName);
		}
		return back();
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
				// variables
			);

		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) 
	    {
	        return back();
	    }

	    $data = CoxTable::find($id);
	    if($data != null)
	    {
	    	// variables
	    	$data->save();
            return redirect("admin/modules/CoxTable");
	    }
	    return back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$data = CoxTable::find($id);
		if($data != null)
		{
			$data->delete();
			return view("CoxTable::admin.".$this->theme.".destroy")
			->with('id', $id)
			->with('headName', $this->headName);
		}
		return back();

		
	}

}
