<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Jobs\PostSlack;
use App\Models\Person;

class PeopleController extends Controller
{
    public function all()
    {
        return response()->json(Person::get());
    }

    public function add(Request $request)
    {
        $person = Person::createWithRelation($request->all());
        $this->dispatch(new PostSlack($person));
        return response()->json($person);
    }

    public function get($id)
    {
        return response()->json(Person::with('relation')->find($id));
    }
}
