<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zombie Apocalypse Simulation</title>
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body class="antialiased">
    <h1>Zombie Apocalypse Simulation</h1>
    @php
    //assigning data to variables
    $averageHealthStatus = $humans->avg('health_status'); //average human health
    $averagePhysicalFitness = $humans->avg('physical_fitness'); //average physical fitness
    $averageResourceConsumption = $humans->avg('resource_consumption'); // average resource consumption
    $actionDecisionCounts = $humans->countBy('action_decision'); //grouping a collection element and returning the number of occurrences of each group
    $mostCommonAction = collect($actionDecisionCounts)->sortDesc()->keys()->first();//sorting the collection in descending order and selecting the first element
    $food = $resources->first()['food'];
    $water = $resources->first()['water'];
    $medical_supplies = $resources->first()['medical_supplies'];
    $weapon = $resources->first()['weapon'];
    $wynik=0;
    $human_capabilities = $humans_count*$averageHealthStatus*$averagePhysicalFitness/$averageResourceConsumption;
    $human_resources_escape = 0.8*$food+0.8*$water+0.4*$medical_supplies+0.4*$weapon;
    $human_resources_fight = 0.4*$food+0.4*$water+0.8*$medical_supplies+0.8*$weapon;
    //if the action chosen by the people is escape then the result is calculated with human_resources_escape and if the action is fight then with human_resources_fight
    @endphp

    <p>Average Health: {{ $averageHealthStatus }}</p>
    <p>Average Physical Fitness: {{ $averagePhysicalFitness }}</p>
    <p>Average Resource Consumption: {{ $averageResourceConsumption }}</p>
    <p>Action decision: {{ $mostCommonAction }}</p>
    <p>Number of people: {{$humans_count}}</p>
    <p>Number of zombies: {{$zombies}}</p>
    <p>Amount of food : {{$food}}</p>
    <p>Amount of water : {{$water}}</p>
    <p>Quantity of medical supplies : {{$medical_supplies}}</p>
    <p>Quantity of weapons : {{$weapon}}</p>
    
    @if($mostCommonAction=='escape')
    @php
    $wynik = ($human_capabilities*$human_resources_escape)-($zombies*10)
    @endphp
    <h2>Result of The Simulation : {{$wynik}}</h2>
    @else
    @php
    $wynik = ($human_capabilities*$human_resources_fight)-($zombies*10)
    @endphp
    <h2>Result of The Simulation : {{$wynik}}</h2>
    @endif

    @if($wynik>100)
    <h1>Humanity has Survived</h1>
    @else
    <h1>Humanity has Extinct</h1>
    @endif
    <form action="{{route('resetDatabase')}}" method="POST">
        @csrf
        <button type="submit">Resets Simulation</button>
    </form>
    <br>
    <form action="{{route('addHuman')}}" method="POST">
        @csrf
        <button type="submit">Add 1 person</button>
    </form>
    <br>
    <form action="{{route('deleteHuman')}}" method="POST">
        @csrf
        <input type="hidden" name="humanId" value="{{$randomHumanId}}">
        <button type="submit">Remove 1 person</button>
    </form>
    <br>
    <form action="{{route('addZombie')}}" method="POST">
        @csrf
        <button type="submit">Add 1 zombie</button>
    </form>
    <br>
    <form action="{{route('deleteZombie')}}" method="POST">
        @csrf
        <input type="hidden" name="zombieId" value="{{$randomZombieId}}">
        <button type="submit">Remove 1 zombie</button>
    </form>
    <br>
    <form action="{{route('updateResources')}}" method="POST">
        @csrf
        <label for="food">Food:</label>
        <input type="number" name="food" id="food" value="{{$food}}">
        <br>
        <label for="water">Water:</label>
        <input type="number" name="water" id="water" value="{{$water}}">
        <br>
        <label for="medical_supplies">Medical Supplies:</label>
        <input type="number" name="medical_supplies" id="medical_supplies" value="{{$medical_supplies}}">
        <br>
        <label for="weapon">Weapon:</label>
        <input type="number" name="weapon" id="weapon" value="{{$weapon}}">
        <br>
        <button type="submit">Update:</button>
    </form>


</body>

</html>