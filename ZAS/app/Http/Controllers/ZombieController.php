<?php

namespace App\Http\Controllers;

use App\Models\Zombie;
use Illuminate\Http\Request;

class ZombieController extends Controller
{
    public function addZombie() //function that adds one zombie
    {
        $zombie = new Zombie;
        $zombie->save();
        return redirect()->back();
    }
    public function deleteZombie(Request $request) //function that removes one zombie
    {
        $zombieId = $request->input('zombieId');
        $zombie = Zombie::find($zombieId);
        if ($zombie) {
            $zombie->delete();
        }
        return redirect()->back();
    }
}
