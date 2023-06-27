<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function updateResources(Request $request) //function that updates resource values in the database
    {
        $resources = Resource::find(1);
        $resources->food = $request->input('food');
        $resources->water = $request->input('water');
        $resources->medical_supplies = $request->input('medical_supplies');
        $resources->weapon = $request->input('weapon');
        $resources->save();
        return redirect()->back();
    }
}
