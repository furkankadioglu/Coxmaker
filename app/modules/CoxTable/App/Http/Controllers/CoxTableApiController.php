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

use App\Http\Controllers\ApiTemplateController;
class CoxTableApiController extends ApiTemplateController {

	public function index()
	{
		$datas = CoxTable::orderBy('id', 'desc')->get();
		return $datas;
	}

	public function create()
	{
		 return response()->json(["target" => "create"]);
	}

	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');
		$apiPassword = $request->header('apiPassword');

		if($apiPassword == Config::get('modulemanagement.apiPassword'))
		{
			if($postCategory == "create")
			{
		 		return response()->json(["target" => "create"]);
			}
		}
	}

	public function show($id)
	{
		 return response()->json(["target" => "show"]);
	}

	public function edit($id)
	{
		 return response()->json(["target" => "edit"]);
	}

	public function update($id)
	{
		 return response()->json(["target" => "update"]);
	}

	public function destroy($id)
	{
		 return response()->json(["target" => "destroy"]);
	}

}
