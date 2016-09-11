<?php namespace App\Modules\CoxTable\App\Models;

use Illuminate\Database\Eloquent\Model;

class CoxTable extends Model {

	//
	protected $table = "coxtable_tables";
	public $timestamps = true;
	protected $guarded = [];

	public function jobs()
	{
		return $this->hasMany("App\Modules\CoxTable\App\Models\Job", "tableId", "id");
	}

	public function persons()
	{
		return $this->hasMany("App\Modules\CoxTable\App\Models\Person", "tableId", "id");
	}

}
