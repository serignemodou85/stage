@extends('layouts.app')

@section('title', 'Détails de la Facture')

@section('content')
    <div class="container mt-5">
        <h2>Détails de la Facture #{{ $facture->numero }}</h2>

        <div class="card mt-4">
            <div class="card-body">
                <p><strong>Client:</strong> {{ $facture->client->nom }} {{ $facture->client->prenom }}</p>
                <p><strong>Date:</strong> {{ $facture->date->format('d/m/Y') }}</p>
                <p><strong>Montant:</strong> {{ number_format($facture->montant, 2) }} €</p>
            </div>
        </div>

        <a href="{{ route('clients.index') }}" class="btn btn-primary mt-3">Retour à la liste des clients</a>
    </div>
@endsection
