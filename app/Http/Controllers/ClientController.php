<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\ClientInscriptionMail;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // Afficher la liste des clients
    public function index()
    {
        $clients = Client::with('logiciels')->where('isDelete', false)->get();
        return view('clients.index', compact('clients'));
    }

    // Afficher le formulaire de création de client
    public function create()
    {
        return view('clients.create'); 
    }
    
    // Pour la page de connexion
    public function showLoginForm()
    {
        return view('clients.login');
    }

    // Stocker un nouveau client
    public function store(Request $request)
    {
        $validatedData = $this->validateClient($request);

        // Générer le nom de base de données
        $validatedData['nom_base_DS'] = $this->generateDatabaseName();

        // Générer le token et la date d'expiration
        $validatedData['token'] = Str::random(60);
        $validatedData['date_expiration_token'] = Carbon::now()->addDays(31);

        // Créer le client dans la base de données
        $client = Client::create($validatedData);

        // Créer une base de données pour le client
        $this->createClientDatabase($validatedData['nom_base_DS']);

        // Gérer l'attachement des logiciels
        $this->attachLogiciels($client, $request->input('id_logiciel'));

        // Envoi d'emails au client et à l'entreprise
        Mail::to($client->email)->send(new ClientInscriptionMail($client));
        Mail::to('toubasoftit@gmail.com')->send(new ClientInscriptionMail($client));

        // Redirection vers la page de connexion avec les informations cryptées
        return redirect()->route('login')->with([
            'encryptedCredentials' => $this->encryptCredentials($client->email, $request->input('password')),
            'success' => 'Avec succès, un email vous a été envoyé.'
        ]);
    }

    // Générer un nom de base de données unique

    // Créer une base de données pour le client
    private function createClientDatabase($databaseName)
    {
        // Implémenter la logique de création de la base de données
        // Exemple : DB::statement("CREATE DATABASE {$databaseName}");
    }

    // Gérer l'attachement des logiciels
    private function attachLogiciels(Client $client, $idLogiciel)
    {
        if ($idLogiciel) {
            $client->logiciels()->attach($idLogiciel);
        }
    }

    // Chiffrement des informations d'identification
    private function encryptCredentials($email, $password)
    {
        // Clé fixe pour le cryptage
        $key = 'b14ca5898a4e4133bbce2ea2315a1916';

        // Concaténation de l'email et du mot de passe
        $credentialsString = $email . '|' . $password;

        // Crypter la chaîne de caractères concaténée avec la clé fixe
        return hash('sha256', $credentialsString);
    }

    // Connexion automatique basée sur les informations cryptées
    public function autoLogin(Request $request)
    {
        $encryptedCredentials = $request->session()->get('encryptedCredentials');

        if (!$encryptedCredentials) {
            return redirect()->route('login')->withErrors('Aucune information de connexion disponible.');
        }

        // Récupérer le client correspondant au token
        $client = Client::where('token', $request->input('token'))->firstOrFail();

        // Vérification des informations
        if ($this->checkCredentials($client, $request->input('password'), $encryptedCredentials)) {
            // Connexion réussie
            Auth::login($client);
            return redirect()->away("https://batora-test.toubasoft.com/UserLogin?credentials=" . urlencode($encryptedCredentials));
        }

        return redirect()->route('login')->withErrors('Échec de la connexion.');
    }

    // Vérification des informations d'identification
    private function checkCredentials(Client $client, $password, $encryptedCredentials)
    {
        return $encryptedCredentials === $this->encryptCredentials($client->email, $password);
    }

    // Afficher le formulaire d'édition d'un client
    public function edit($id)
    {
        $client = Client::findOrFail($id);  
        return view('clients.edit', compact('client')); 
    }

    // Mettre à jour les informations d'un client
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validatedData = $this->validateClient($request, $client->id); // Validation des données

        $client->update($validatedData); 

        return redirect()->route('clients.index')->with('success', 'Client mis à jour avec succès.'); // Redirection après mise à jour
    }

    // Suppression mais pas définitivement
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete(); 
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.'); // Redirection après suppression
    }

    // Restaurer un client supprimé
    public function restore($id)
    {
        $client = Client::withTrashed()->findOrFail($id);
        $client->restore(); 
        return redirect()->route('clients.trashed')->with('success', 'Client restauré avec succès.'); // Redirection après restauration
    }

    // Afficher la corbeille
    public function trashed()
    {
        $clients = Client::onlyTrashed()->get(); 
        return view('clients.trashed', compact('clients')); // Retourner la vue de la corbeille
    }

    // Supprimer définitivement un client
    public function forceDelete($id)
    {
        $client = Client::withTrashed()->findOrFail($id);
        $client->forceDelete(); // Suppression définitive
        return redirect()->route('clients.trashed')->with('success', 'Client supprimé définitivement.'); // Redirection après suppression définitive
    }

    // Activer le token d'un client
    public function activerToken(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'days' => 'required|integer|min:1|max:31',
        ]);

        $days = (int) $validatedData['days'];
        $client->actif = 1;
        $client->token = Str::random(60);
        $client->date_expiration_token = Carbon::now()->addDays($days); 
        $client->save(); // Sauvegarder les modifications

        return redirect()->route('clients.index')->with('success', 'Token activé pour ' . $days . ' jours.'); 
    }

    // Désactiver le token d'un client
    public function desactiverToken(Client $client)
    {
        $client->actif = 0; // Désactiver le client
        $client->token = null; // Supprimer le token
        $client->date_expiration_token = null; // Supprimer la date d'expiration
        $client->save(); // Sauvegarder les modifications

        return redirect()->route('clients.index')->with('success', 'Token désactivé.'); // Redirection après désactivation
    }

    // Validation des données du client
    private function validateClient(Request $request, $clientId = null)
    {
        return $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email,' . $clientId . ',id,isDelete,0',
            'telephone' => 'required|string|max:15|unique:clients,telephone,' . $clientId . ',id,isDelete,0',
            'nom_entreprise' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255|unique:clients,immatriculation,' . $clientId . ',id,isDelete,0',
            'actif' => 'required|boolean',
            'password' => 'nullable|min:8', 
        ]);
    }
}
