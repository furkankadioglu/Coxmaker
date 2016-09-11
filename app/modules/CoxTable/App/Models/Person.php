<?php namespace App\Modules\CoxTable\App\Models;


use App\Modules\CoxTable\App\Models\Job;
use Illuminate\Database\Eloquent\Model;

class Person extends Model {

	//
	protected $table = "coxtable_persons";
	public $timestamps = true;
	protected $guarded = [];

	public function result($jobId)
	{
		$userId = $this->attributes["id"];
		$result = Result::where('jobId', $jobId)->where('personId', $userId)->first();
		if($result)
			return $result;
		else
			return 0;
	}


}
