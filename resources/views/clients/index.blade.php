@extends('layouts.app')

@section('title', 'Liste des Clients')

@section('content')
    <div class="container-fluid mt-4 px-4">
        <!-- En-tête avec réduction des marges et padding -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary fw-bold" style="margin-bottom: 0.5rem;">Liste des Clients</h2>
            <a href="{{ route('clients.create') }}" class="btn btn-outline-primary btn-lg shadow-sm">
                <i class="fas fa-plus-circle"></i> Ajouter un Client
            </a>
            <a href="{{ route('clients.trashed') }}"  class="btn btn-outline-primary btn-lg shadow-sm">
                <i class="fas fa-trash-alt"></i> Voir la Corbeille
            </a>
        </div>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show fs-5" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Affichage d'un message si aucun client n'est trouvé -->
        @if($clients->isEmpty())
            <div class="alert alert-info text-center fs-4">
                <i class="fas fa-info-circle"></i> Aucun client trouvé.
            </div>
        @else
            <!-- Table des clients avec des espaces réduits entre les éléments -->
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
                                    <th class="py-2">Mot de Passe</th>
                                    <th class="py-2">Téléphone</th>
                                    <th class="py-2">Immatr.</th>
                                    <th class="py-2">Nom Base</th>
                                    <th class="py-2">Nom Logiciel</th>
                                    <th class="py-2">Statut</th>
                                    <th class="py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td class="py-2">{{ $client->nom }}</td>
                                        <td class="py-2">{{ $client->prenom }}</td>
                                        <td class="py-2">{{ $client->nom_entreprise }}</td>
                                        <td class="py-2">{{ $client->email }}</td>
                                        <td class="py-2">{{ $client->password }}</td>
                                        <td class="py-2">{{ $client->telephone }}</td>
                                        <td class="py-2">{{ $client->immatriculation }}</td>
                                        <td class="py-2">{{ $client->nom_base_DS }}</td>
                                        <td>
                                            @foreach($client->logiciels as $logiciel)
                                                {{ $logiciel->nom_logiciel }}@if (!$loop->last), @endif
                                            @endforeach
                                         </td>
                                        <td class="py-2">
                                            <span class="badge {{ $client->actif ? 'bg-success' : 'bg-danger' }} fs-6">
                                                {{ $client->actif ? 'Actif' : 'Inactif' }}
                                            </span>
                                        </td>
                                        <td class="d-flex justify-content-center py-2">
                                            <a href="{{ route('factures.show', $client->id) }}" class="btn btn-info btn-sm me-2" title="Voir Facture">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm me-2" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm me-2" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @if($client->actif)
                                                <form action="{{ route('clients.desactiverToken', $client->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Désactiver Token">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('clients.activerToken', $client->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="days" class="form-select form-select-sm d-inline-block me-2" style="width: auto;">
                                                        <option value="" disabled selected>Choisissez une durée</option>
                                                        @for($i = 1; $i <= 31; $i++)
                                                            <option value="{{ $i }}">{{ $i }} {{ Str::plural('jour', $i) }}</option>
                                                        @endfor
                                                    </select>
                                                    <button type="submit" class="btn btn-success btn-sm" title="Activer Token">
                                                        <i class="fas fa-check-circle"></i> Activer
                                                    </button>
                                                </form>
                                            @endif
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
