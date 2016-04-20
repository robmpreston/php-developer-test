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
		 $person = Person::create($input);

		 $relation = new Relation;
		 $relation->fill($input);

		 $person->relation()->save($relation);
		 $person->save();

		 return $person;
	}

	public function updateWithRelation($input)
	{
		$this->update($input);
		$this->save();

		$relation = $this->relation;
		$relation->update($input['relation']);
		$relation->save();

		return $this;
	}
}
