@extends('layouts.app') 

@section('title', 'Clients Supprimés')

@section('content')
    <div class="container-fluid mt-4 px-4">
        <!-- En-tête avec bouton retour à la liste des clients -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-danger fw-bold" style="margin-bottom: 0.5rem;">Clients Supprimés</h2>
            <a href="{{ route('clients.index') }}" class="btn btn-outline-primary btn-lg shadow-sm">
                <i class="fas fa-arrow-left"></i> Retour à l'accueil
            </a>
        </div>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show fs-5" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Affichage d'un message si aucun client supprimé n'est trouvé -->
        @if($clients->isEmpty())
            <div class="alert alert-info text-center fs-4">
                <i class="fas fa-info-circle"></i> Aucun client supprimé trouvé.
            </div>
        @else
            <!-- Table des clients supprimés -->
            <div class="card shadow-sm mb-3">
                <div class="card-body py-2">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered text-center fs-6">
                            <thead class="table-dark">
                                <tr>
                                    <th class="py-2">Nom</th>
                                    <th class="py-2">Prénom</th>
                                    <th class="py-2">Entreprise</th>
                                    <th class="py-2">Email</th>
                                    <th class="py-2">Téléphone</th>
                                    <th class="py-2">Immatr.</th>
                                    <th class="py-2">Nom_Base</th>
                                    <th class="py-2">Nom_Logiciel</th>
                                    <th class="py-2">Date de Suppression</th>
                                    <th class="py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->nom }}</td>
                                        <td>{{ $client->prenom }}</td>
                                        <td>{{ $client->nom_entreprise }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->telephone }}</td>
                                        <td>{{ $client->immatriculation }}</td>
                                        <td>{{ $client->nom_base_DS }}</td>
                                        <td>{{ $client->nom_logiciel_DS }}</td>
                                        <td>{{ $client->deleted_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <form action="{{ route('clients.restore', $client->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" title="Restaurer">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('clients.forceDelete', $client->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer Définitivement" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client définitivement ?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
