<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
     
    </head>
    <body class="antialiased">
        <ul>
    @foreach($humans as $human)
    <p>ID: {{ $human->id }}</p>
    <p>Health Status: {{ $human->health_status }}</p>
    <p>Physical Fitness: {{ $human->physical_fitness }}</p>
    <p>Resource Consumption: {{ $human->resource_consumption }}</p>
    <p>Action Decision: {{ $human->action_decision }}</p>
    <hr>
@endforeach
</ul>

    </body>
</html>
