<?php 

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FactureController;



Route::get('/', function () {
    return redirect()->route('clients.index');
});
//gerer la connexion automatique 

Route::post('/clients/login', [ClientController::class, 'autoLogin'])->name('clients.autoLogin');

// Routes pour les clients, la page de connexion et la facture

Route::get('/clients/login', [ClientController::class, 'showLoginForm'])->name('login');

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');


Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');

Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');

Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

Route::post('clients/restore/{id}', [ClientController::class, 'restore'])->name('clients.restore');

Route::get('/clients/trashed', [ClientController::class, 'trashed'])->name('clients.trashed');

Route::delete('/clients/trashed/{id}', [ClientController::class, 'forcedelete'])->name('clients.forceDelete');

Route::get('/clients/{client}/facture', [ClientController::class, 'show'])->name('clients.show');

Route::get('/factures/{id}', [FactureController::class, 'show'])->name('factures.show');

Route::patch('clients/{client}/desactiver-token', [ClientController::class, 'desactiverToken'])->name('clients.desactiverToken');

Route::patch('clients/{client}/activer-token', [ClientController::class, 'activerToken'])->name('clients.activerToken');

