<?php

use App\Livewire\Counter;
use App\Models\AyantDroit;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdherantController;
use App\Http\Controllers\Auth\AdherantAuthenticatedSessionController;
use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\AyantDroitController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\DemandeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return redirect('/login');
// });
Route::get('/', [AccueilController::class, 'accueil'])->name(name: 'accueil');
Route::get('/formulaire-adhesion', [AccueilController::class, 'newAdhesion'])->name(name: 'formulaire-adhesion');
Route::get('/resume-adhesion/{id}', [AccueilController::class, 'resumeAdhesion'])->name('resume-adhesion');
Route::get('/demande-adhesion/{id}/fiche-cession-volontaire', [AccueilController::class, 'downloadCessionFiche'])
    ->name('download-fiche-cession-volontaire');
Route::get('download-form-adhesion/{id}', [AccueilController::class, 'downloadFormAdhesion'])->name('download-form-adhesion');
Route::post('/recapitulatif-form', [AccueilController::class, 'recapitulatifForm'])->name('recapitulatif-form');
Route::get('/formulaire-adhesion-recapitulatif', function () {
    return view('components.formulaire-adhesion'); 
})->name('formulaire.adhesion.recapitulatif');
Route::post('/finalisation-adhesion', [AccueilController::class, 'finalAdhesion'])->name('finalisation-adhesion');
Route::get('/cession-volontaire/{id}', [AccueilController::class, 'showCessionVolontaire'])->name('showCessionVolontaire');
Route::get('/impression-fiche-cession/{id}', [AccueilController::class, 'imprimerFicheCession'])->name('imprimer-fiche-cession');

Route::get('/login/adherant', [AdherantAuthenticatedSessionController::class, 'create'])->name('adherant.login');
Route::post('/login/adherant', [AdherantAuthenticatedSessionController::class, 'store']);
Route::get('/adherents/dashboard', [AdherantAuthenticatedSessionController::class, 'dashboard'])
    ->name('adherents.dashboard')
    ->middleware('auth:adherent');
Route::post('/logout', [AdherantAuthenticatedSessionController::class, 'destroy'])
    ->name('adherant.logout')
    ->middleware('auth:adherent');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/counter', Counter::class);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/import-csv', [CsvImportController::class, 'import'])->name('import-csv');
    Route::post('/ayantdroits/import', [AyantDroitController::class, 'import'])->name('ayantdroits.import');

    Route::get('/prestations/{id}/recu', action: [PrestationController::class, 'downloadReceipt'])->name('prestations.downloadReceipt');
    Route::get('/prestations/suivi', [PrestationController::class, 'suivi'])->name('suivi');
    Route::get('/consultation/suivi', [PrestationController::class, 'suiviConsultation'])->name('suivi-consultation');
    Route::get('/radio/suivi', [PrestationController::class, 'suiviRadio'])->name('suivi-radio');
    Route::get('/maternite/suivi', [PrestationController::class, 'suiviMaternite'])->name('suivi-maternite');
    Route::get('/allocation/suivi', [PrestationController::class, 'suiviAllocation'])->name('suivi-allocation');
    Route::get('/analyse-biomedicale/suivi', [PrestationController::class, 'suiviAnalyseBiomedicale'])->name('suivi-analyse-biomedicale');
    Route::get('/pharmacie/suivi', [PrestationController::class, 'suiviPharmacie'])->name('suivi-pharmacie');
    Route::get('/optique/suivi', [PrestationController::class, 'suiviOptique'])->name('suivi-optique');
    Route::get('/dentaire-auditif/suivi', [PrestationController::class, 'suiviDentaireAuditif'])->name('suivi-dentaire-auditif');
    Route::get('/autre/suivi', [PrestationController::class, 'suiviAutre'])->name('suivi-autre');


    Route::resource('adherants', AdherantController::class);
    Route::resource('ayantsdroits', AyantDroitController::class);
    Route::resource('prestations', PrestationController::class);
    Route::resource('cotisations', CotisationController::class);
    Route::resource('parametres', ParametreController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('demandes', DemandeController ::class);
    Route::get('/edit-demande-adhesion/{id}', App\Livewire\EditMembership::class)->name('edit-demande-adhesion');


    Route::get('/test-ayantsdroits/{id}/edit', function ($id) {
        $ayantDroit =  AyantDroit::find(3);
        return view('pages.ayantsdroits.edit', compact('ayantDroit'));
    });
    
    

    Route::get('/get-data', [CotisationController::class, 'getData']);

    Route::post('/prestations/{id}/valider', [PrestationController::class, 'valider'])->name('prestations.valider');
    Route::post('/prestations/{id}/rejeter', [PrestationController::class, 'rejeter'])->name('prestations.rejeter');
    Route::post('/prestations/{id}/validerpaiement', [PrestationController::class, 'validerPaiement'])->name('prestations.validerpaiement');
});

require __DIR__.'/auth.php';
