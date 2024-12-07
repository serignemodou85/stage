@extends('layouts.app') 
@section('content')


<!DOCTYPE html> 
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        @if(session('credentials'))
            @php
                // Récupérer les informations cryptées de la session
                $credentials = session('credentials');
            @endphp
            <a href="https://batora-test.toubasoft.com/UserLogin?credentials={{ urlencode($credentials) }}" class="btn btn-primary">Se connecter</a>
        @else
            <p>Aucune information de connexion disponible.</p>
        @endif
    </div>
</body>
</html>
