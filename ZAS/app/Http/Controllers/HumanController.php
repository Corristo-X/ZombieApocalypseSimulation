<?php

namespace App\Http\Controllers;

use App\Models\Human;
use App\Models\Resource;
use App\Models\Zombie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;


class HumanController extends Controller
{
    public function index()
    {
        $humans = Human::all();

        return view('humans.index', ['humans' => $humans]);
    }
    public function index_avg()
    {
        if (!Schema::hasTable('humans')) {
            Artisan::call('migrate');
            Artisan::call('db:seed');
        }
        $humans = Human::all();
        $randomHumanId = Human::inRandomOrder()->value('id');
        $randomZombieId = Zombie::inRandomOrder()->value('id');
        $humans_count = count($humans);
        $resources = Resource::all();
        $zombies = Zombie::count();
        return view('welcome', compact('humans', 'resources', 'zombies', 'humans_count', 'randomHumanId', 'randomZombieId'));
    }
    public function reset()
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        return redirect()->back()->with('success', 'Symulacja zostala zresetowana');
    }
    public function addHuman()
    {
        $healthStatus = rand(0, 100) / 100;
        $physicalFitness = rand(0, 10);
        $resourceConsumption = rand(0, 10);
        $actionDecision = ['fight', 'escape'][rand(0, 1)];


        $human = new Human;
        $human->health_status = $healthStatus;
        $human->physical_fitness = $physicalFitness;
        $human->resource_consumption = $resourceConsumption;
        $human->action_decision = $actionDecision;
        $human->save();

        return redirect()->back();
    }
    public function deleteHuman(Request $request)
    {
        $humanId = $request->input('humanId');
        $human = Human::find($humanId);
        if ($human) {
            $human->delete();
        }
        return redirect()->back();
    }
    public function addZombie()
    {
        $zombie = new Zombie;
        $zombie->save();
        return redirect()->back();
    }
    public function deleteZombie(Request $request)
    {
        $zombieId = $request->input('zombieId');
        $zombie = Zombie::find($zombieId);
        if ($zombie) {
            $zombie->delete();
        }
        return redirect()->back();
    }
    public function updateResources(Request $request)
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
