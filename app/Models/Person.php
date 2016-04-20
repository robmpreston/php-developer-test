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

	public function buildTree($getSpouse = true)
	{
		$tree = [
			'name' => $this->getName()
		];

		if ($this->relation->father != null) {
			$tree['father'] = $this->relation->father->buildTree();
		}

		if ($this->relation->mother != null) {
			$tree['mother'] = $this->relation->mother->buildTree(false);
		}

		if ($getSpouse && $this->relation->spouse != null) {
			$tree['spouse'] = $this->relation->spouse->buildTree(false);
		}

		return $tree;
	}

	private function getName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}
}
