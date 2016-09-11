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
use Cache;

// Helpers
use App\BaseHelpers;
use App\Modules\CoxTable\App\CoxTableHelpers as ModuleHelpers;

// Models
use App\Modules\CoxTable\App\Models\CoxTable;
use App\Modules\CoxTable\App\Models\CoxTableModuleSetting;


use App\Http\Controllers\AdminTemplateController;
class CoxTableAdminSettingsController extends AdminTemplateController {

	public $headName = "CoxTable Module Settings";


	public function index()
	{
		$datas = CoxTableModuleSetting::orderBy('id', 'desc')->get();
		return view("CoxTable::admin.".$this->theme.".settings.index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}

	public function create()
	{
		return view("CoxTable::admin.".$this->theme.".settings.create")
		->with('headName', $this->headName);
	}

	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "create")
		{
			$rules = array(
				'displayName' => 'required|max:255',
				'name' => 'required|unique:CoxTable_settings|max:255',
				'attribute' => 'required|max:255'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
				return back()->withErrors($validator);
            }

            $settingDisplayName = $request->get('displayName');
            $settingName = str_slug($request->get('name'));
            $settingAttribute = $request->get('attribute');

			$data = CoxTableModuleSetting::create([
				'displayName' => $settingDisplayName,
				'name' => $settingName,
				'attribute' => $settingAttribute
			]);

			$withCache = BaseHelpers::cacheAddOrUpdate("CoxTable" ,$settingName, "");

            return redirect("admin/modules/CoxTable/settings");
		}

		return back();
	}

	public function update(Request $request)
	{
		$settings = CoxTableModuleSetting::orderBy('id', 'desc')->get();
		foreach($settings as $setting)
		{
			$setting->value = $request->get($setting->name);
			$setting->save();
			$withCache = BaseHelpers::cacheAddOrUpdate("CoxTable", $setting->name, $setting->value);
		}
           return redirect("admin/modules/CoxTable/settings");
	}

	public function destroy($id)
	{
		$data = CoxTableModuleSetting::find($id);
		if($data != null)
		{
			$data->delete();
			Cache::pull("CoxTableModule-".$data->name);
		}
		return back();

		
	}

}
