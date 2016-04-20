<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relation extends Model {

	protected $table = 'relations';
	public $timestamps = false;

	use SoftDeletes;
	protected $visible = ['father_id', 'mother_id', 'spouse_id'];
	protected $fillable = [ 'father_id', 'mother_id', 'spouse_id' ];
	protected $dates = ['deleted_at'];
	protected $guarded = [ 'id' ];
	protected $primaryKey = 'person_id';

	public function father()
	{
		return $this->hasOne('App\Models\Person', 'id', 'father_id');
	}

	public function mother()
	{
		return $this->hasOne('App\Models\Person', 'id', 'mother_id');
	}

	public function spouse()
	{
		return $this->hasOne('App\Models\Person', 'id', 'spouse_id');
	}

	public function person()
	{
		return $this->belongsTo('App\Models\Person');
	}
}
