<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FactureController extends Controller
{
    public function show($id)
    {
        // Récupérer la facture avec l'ID donné
        $facture = Facture::findOrFail($id);

        // Retourner la vue avec les détails de la facture
        return view('factures.show', compact('facture'));
    }
    
    // Méthode pour afficher la liste des factures
    public function index()
    {
        $factures = Facture::all();
        return view('factures.index', compact('factures'));
    }

    // Méthode pour afficher le formulaire de création de facture
    public function create()
    {
        return view('factures.create');
    }

    // Méthode pour stocker une nouvelle facture
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'numero' => 'required|string|max:255|unique:factures',
            'date' => 'required|date',
            'montant' => 'required|numeric|min:0',
            'regle' => 'nullable|string',
            'date_limite' => 'nullable|date',
        ]);

        // Création de la facture
        Facture::create($validatedData);

        // Redirection avec message de succès
        return redirect()->route('factures.index')->with('success', 'Facture ajoutée avec succès.');
    }


}
