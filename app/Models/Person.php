<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Relation;

class Person extends Model {

	protected $table = 'people';
	public $timestamps = false;

	use SoftDeletes;
	protected $visible = [ 'id', 'first_name', 'last_name', 'relation'];
	protected $fillable = [ 'first_name', 'last_name' ];
	protected $dates = ['deleted_at'];

	public function relation()
	{
		return $this->hasOne('App\Models\Relation');
	}

	public static function createWithRelation($input)
	{
		 $person = Person::create([
			 'first_name' => $input['first_name'],
			 'last_name' => $input['last_name']
		 ]);

		 $relation = new Relation;
		 $relation->father_id = $input['father_id'];
		 $relation->mother_id = $input['mother_id'];
		 $relation->spouse_id = $input['spouse_id'];

		 $person->relation()->save($relation);
		 $person->save();

		 dd($person);
	}
}
