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
        return response()->json(Person::with('relation')->get());
    }

    public function get($id)
    {
        return response()->json(Person::with('relation')->find($id));
    }

    public function getTree($id)
    {
        return response()->json([Person::find($id)->buildTree()]);
    }

    public function add(Request $request)
    {
        $person = Person::createWithRelation($request->all());
    //    $this->dispatch(new PostSlack($person));
        return response()->json($person);
    }

    public function remove($id)
    {
        Person::find($id)->delete();
        return response()->json(['success' => 'true']);
    }

    public function update($id, Request $request)
    {
        $person = Person::find($id);
        if ($person) {
            return $person->updateWithRelation($request->all());
        }
        return false;
    }
}
