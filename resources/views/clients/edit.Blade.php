@extends('layouts.app')

@section('title', 'Modifier le Client')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header text-white" style="background: linear-gradient(45deg, #6a11cb, #2575fc);">
                        <h2 class="text-center mb-0">Modifier Client</h2>
                    </div>

                    <div class="card-body p-5">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Succès :</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('clients.update', $client->id) }}" method="POST" class="form-horizontal">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="nom" class="form-label">Nom <i class="fas fa-user"></i></label>
                                <input type="text" class="form-control form-control-lg rounded-pill shadow-sm" id="nom" name="nom" value="{{ old('nom', $client->nom) }}" required placeholder="Entrez votre Nom ">
                            </div>

                            <div class="mb-4">
                                <label for="prenom" class="form-label">Prénom <i class="fas fa-user"></i></label>
                                <input type="text" class="form-control form-control-lg rounded-pill shadow-sm" id="prenom" name="prenom" value="{{ old('prenom', $client->prenom) }}" placeholder="Entrez votre prénom ">
                            </div>

                            <div class="mb-4">
                                <label for="adresse" class="form-label">Adresse <i class="fas fa-map-marker-alt"></i></label>
                                <input type="text" class="form-control form-control-lg rounded-pill shadow-sm" id="adresse" name="adresse" value="{{ old('adresse', $client->adresse) }}" required placeholder="Entrez votre adresse ">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email <i class="fas fa-envelope"></i></label>
                                <input type="email" class="form-control form-control-lg rounded-pill shadow-sm" id="email" name="email" value="{{ old('email', $client->email) }}" required placeholder="Entrez votre mail ">
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Mot de passe <i class="fas fa-password"></i></label>
                                <input type="password" class="form-control form-control-lg rounded-pill shadow-sm" id="password" name="password" placeholder="Entrez un nouveau mot de passe">
                            </div>

                            <div class="mb-4">
                                <label for="telephone" class="form-label">Téléphone <i class="fas fa-phone"></i></label>
                                <input type="text" class="form-control form-control-lg rounded-pill shadow-sm" id="telephone" name="telephone" value="{{ old('telephone', $client->telephone) }}" required placeholder="Entrez le numéro de téléphone">
                            </div>

                            <div class="mb-4">
                                <label for="nom_entreprise" class="form-label">Nom de l'entreprise <i class="fas fa-building"></i></label>
                                <input type="text" class="form-control form-control-lg rounded-pill shadow-sm" id="nom_entreprise" name="nom_entreprise" value="{{ old('nom_entreprise', $client->nom_entreprise) }}" required placeholder="Entrez le nom de l'entreprise">
                            </div>

                            <div class="mb-4">
                                <label for="immatriculation" class="form-label">Immatriculation <i class="fas fa-file-alt"></i></label>
                                <input type="text" class="form-control form-control-lg rounded-pill shadow-sm" id="immatriculation" name="immatriculation" value="{{ old('immatriculation', $client->immatriculation) }}" required placeholder="Entrez l'immatriculation">
                            </div>     

                            <div class="form-check form-switch mb-4">
                                <input type="checkbox" class="form-check-input" id="actif" name="actif" value="1" {{ old('actif', $client->actif) ? 'checked' : '' }}>
                                <label class="form-check-label" for="actif">Actif <i class="fas fa-check-circle"></i></label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm">
                                Enregistrer <i class="fas fa-save ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
