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

	public function getNameAttribute()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public static function createWithRelation($input)
	{
		 $person = Person::create($input);

		 $relation = new Relation;
		 $relation->fill($input);

		 $person->relation()->save($relation);
		 $person->save();

	 	 // Update the spouse to have this person as their spouse as well
		 if ($person->relation->spouse != null) {
		     $spouse = $person->relation->spouse;
			 $spouse->relation->spouse_id = $person->id;
			 $spouse->relation->save();
		 }

		 return $person;
	}

	public function updateWithRelation($input)
	{
		$this->update($input);
		$this->save();

		$relation = $this->relation;
		$relation->update($input['relation']);
		$relation->save();

		// Update the spouse to have this person as their spouse as well
		if ($this->relation->spouse != null) {
			$spouse = $this->relation->spouse;
			$spouse->relation->spouse_id = $this->id;
			$spouse->relation->save();
		}

		return $this;
	}

	public function buildTree($getSpouse = true, $prefix = '')
	{
		$treeHtml = '<ul><li>' . $prefix . $this->name . '</li>';

		if ($this->relation->father != null) {
	 		$treeHtml .= $this->relation->father->buildTree(true, 'Father: ');
		}

		if ($this->relation->mother != null) {
			$treeHtml .= $this->relation->mother->buildTree(false, 'Mother: ');
		}

		if ($getSpouse && $this->relation->spouse != null) {
			$treeHtml .= $this->relation->spouse->buildTree(false, 'Spouse: ');
		}
		$treeHtml .= '</ul>';
		return $treeHtml;
	}
}
