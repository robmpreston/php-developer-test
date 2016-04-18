<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Person;

class PeopleController extends Controller
{
    public function all()
    {
        return response()->json(Person::get());
    }

    public function add(Request $request)
    {
        $input = $request->all();
        $person = Person::createWithRelation($input);
    }

    public function get($id)
    {
        return response()->json(Person::with('relation')->find($id));
    }
}
