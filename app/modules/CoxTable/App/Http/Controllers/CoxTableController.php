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
use Mail;
use Cache;
use Blade;

// Helpers
use App\Modules\CoxTable\App\CoxTableHelpers as ModuleHelpers;

// Models
use App\Modules\CoxTable\App\Models\CoxTable;
use App\Modules\CoxTable\App\Models\Job;
use App\Modules\CoxTable\App\Models\Person;
use App\Modules\CoxTable\App\Models\Result;
use App\Modules\CoxTable\App\Models\CoxTableModuleSetting;


use App\Http\Controllers\MainTemplateController;
class CoxTableController extends MainTemplateController {

	public function index()
	{
		Blade::setEscapedContentTags('[[', ']]');
    	Blade::setContentTags('[[[', ']]]');
		$datas = CoxTable::orderBy('id', 'desc')->get();
		return view("CoxTable::".$this->theme.".index")
		->with('datas', $datas);
	}

	public function show($id)
	{
		$key = $id;

		$table = CoxTable::where('key', $key)->first();

		if($table)
		{
			return view("CoxTable::".$this->theme.".show")
			->with('table', $table);
		}
		else
		{
			return back();
		}
	}

	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');
		if($postCategory == "create")
		{
				$rules = array(
					'ortaklar' => 'required',
					'isler' => 'required',
					'emailler' => 'required',
					'g-recaptcha-response' => 'required|captcha',
					'projectname' => 'required'
				);

			    foreach($request->get('emailler') as $key => $val)
			    {
			    	$rules['emailler.'.$key] = 'required';
			    }

			    foreach($request->get('isler') as $key => $val)
			    {
			    	$rules['isler.'.$key] = 'required';
			    }

			    foreach($request->get('ortaklar') as $key => $val)
			    {
			    	$rules['ortaklar.'.$key] = 'required';
			    }

				$validator = Validator::make($request->all(), $rules);

				foreach($request->get('emailler') as $key => $val)
			    {
			    	$errors['emailler.'.$key] = 'required';
			    }

				if($validator->fails()) 
			    {
		            return back()->withErrors($validator);
			    }

			    $ortaklar = $request->get('ortaklar');
			    $isler = $request->get('isler');
			    $emailler = $request->get('emailler');
			    $projectname = $request->get('projectname');

			    $tbl = new CoxTable;
		    	$tbl->name = $projectname;
		    	$tbl->status = 1;
		    	$tbl->key = md5(time()).rand(999,999999);
		    	$tbl->save();

		    	$i = 0;
			    foreach($ortaklar as $ortak)
			    {
			    	$person = new Person;
			    	$person->name = $ortak;
			    	$person->email = $emailler[$i];
			    	$person->pkey = md5(time()).rand(999,99199);
			    	$person->tableId = $tbl->id;
			    	$person->save();

			    	$message = "Hello ".$ortak.", Please fill the textares. <br><br> <strong>Here is your coxtable edit link:</strong> <br> ".url('CoxTable/'.$tbl->key."/".$person->pkey)."<br> <br>";
       				$contentData = [
	            	'title'		=> 'Coxmaker',
	            	'content'	=> $message,
		            'brandname' => 'Coxmaker'
		            ];

		            $title = $projectname." | CoxTable Request";
		            $email = $person->email;
		 
		            Mail::send("masters.mail", $contentData, function($message) use ($email, $title)
		            {
		                $amail = $email;
		                $message->to($amail, Cache::get('brand-name'))->subject($title);
		            });

			    	$i++; 

			    }

			    foreach($isler as $is)
			    {
			    	$person = new Job;
			    	$person->name = $is;
			    	$person->tableId = $tbl->id;
			    	$person->save();
			    }



				return redirect('/CoxTable/'.$tbl->key);
			}
			elseif($postCategory == "edit")
			{
				$rules = array(
					'g-recaptcha-response' => 'required|captcha',
				);


				$validator = Validator::make($request->all(), $rules);

				if($validator->fails()) 
			    {
		            return back()->withErrors($validator);
			    }

			    $ortaklar = $request->get('ortaklar');
			    $isler = $request->get('isler');
			    $veriler = $request->get('veriler');
			    $projectname = $request->get('projectname');
			    $mainPersonId = $request->get('mainPersonId');
			    $tableId = $request->get('tableId');

			    $table = CoxTable::where('id', $tableId)->first();

			    // Check for 100
			   	foreach($veriler as $userId => $jobIds)
			   	{
			   		$sum = 0;

			   		foreach($jobIds as $jobId => $value)
			   		{
			   			if($userId == $mainPersonId)
				   		{
					   			if(is_numeric($value))
					   			{
					   				$sum += $value;
					   			}
				   		}
			   		}
			   		
			   	}
			   	//$sum;
			   	if($sum == 100)
			   	{
			   		foreach($veriler as $userId => $jobIds)
				   	{

				   		// Delete Old Results
		   				$oldResults = Result::where('personId', $mainPersonId)->get();
		   				foreach($oldResults as $or)
		   				{
		   					$or->delete();
		   				}

				   		foreach($jobIds as $jobId => $value)
				   		{

				   			if($userId == $mainPersonId)
					   		{
						   			$result = new Result;
						   			$result->jobId = $jobId;
						   			$result->personId = $mainPersonId;
						   			$result->tableId = $tableId;
						   			$result->point = $value;
						   			$result->save();
					   		}
				   		}
				   	}
			   		
			   	}

				return redirect('/CoxTable/'.$table->key);

			}

	}

	public function create()
	{
		return back();
	}

	public function updateData($key, $userId)
	{

		$person = Person::where('pkey', $userId)->first();
		$table = CoxTable::where('key', $key)->first();

		if($key && $person)
		{

			if($table)
			{
				return view("CoxTable::".$this->theme.".update")
				->with('table', $table)
				->with('mainPerson', $person);
			}
			else
			{
				return back();
			}
		}
		else
		{
			return redirect("/");
		}

	}

	public function edit($id)
	{
		return back();
	}

}
