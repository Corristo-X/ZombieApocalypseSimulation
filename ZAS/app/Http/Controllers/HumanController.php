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
        if (!Schema::hasTable('humans')) { //if the humans table does not exist the we execute the commands in {}
            Artisan::call('migrate');
            Artisan::call('db:seed');
        }
        $humans = Human::all(); //collection of all people
        $randomHumanId = Human::inRandomOrder()->value('id'); // selecting the id of a random person
        $randomZombieId = Zombie::inRandomOrder()->value('id'); // selecting the id of a random zombie
        $humans_count = count($humans); //counting all the people
        $resources = Resource::all(); //collection of all resources
        $zombies = Zombie::count(); //counting all the zombies
        return view('welcome', compact('humans', 'resources', 'zombies', 'humans_count', 'randomHumanId', 'randomZombieId'));
        //returning a welcome view and sending an array containing variables
    }
    public function reset() //a function that resets the apocalypse simualtion
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        return redirect()->back()->with('success', 'Symulacja zostala zresetowana');
    }
    public function addHuman() //a function that adds 1 person and assigns random values to it
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

        return redirect()->back(); //redirecting the user to the previous page
    }
    public function deleteHuman(Request $request) // a function that removes a random person from the database
    {
        $humanId = $request->input('humanId');
        $human = Human::find($humanId);
        if ($human) {
            $human->delete();
        }
        return redirect()->back();
    }
}
