<?php

use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\EstimationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\AdherentController;

use App\Http\Controllers\Backend\CsvImportController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ParametreController;
use App\Http\Controllers\Backend\AyantDroitController;
use App\Http\Controllers\Backend\BudgetController;

use App\Http\Controllers\Backend\CaisseController;
use App\Http\Controllers\Backend\CategorieController;
use App\Http\Controllers\Backend\CotisationController;
use App\Http\Controllers\Backend\PrestationController;
use App\Http\Controllers\Backend\DemandeController;
use App\Http\Controllers\Backend\DepenseController;
use App\Http\Controllers\Backend\EstimationeController;
use App\Http\Controllers\Backend\PartenaireController;
use App\Http\Controllers\Backend\RecetteController;
use App\Http\Controllers\Backend\RestrictionController;

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

// routes/admin.php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/import-csv', [CsvImportController::class, 'import'])->name('import-csv');
    Route::post('/ayantdroits/import', [AyantDroitController::class, 'import'])->name('ayantdroits.import');

    Route::get('/prestations/{id}/recu', action: [PrestationController::class, 'downloadReceipt'])->name('prestations.downloadReceipt');
    Route::get('/hospitalisation/suivi', action: [PrestationController::class, 'suivi'])->name('suivi-hospitalisation');
    Route::get('/consultation/suivi', [PrestationController::class, 'suiviConsultation'])->name('suivi-consultation');
    Route::get('/radio/suivi', [PrestationController::class, 'suiviRadio'])->name('suivi-radio');
    Route::get('/maternite/suivi', [PrestationController::class, 'suiviMaternite'])->name('suivi-maternite');
    Route::get('/allocation/suivi', [PrestationController::class, 'suiviAllocation'])->name('suivi-allocation');
    Route::get('/analyse-biomedicale/suivi', [PrestationController::class, 'suiviAnalyseBiomedicale'])->name('suivi-analyse-biomedicale');
    Route::get('/pharmacie/suivi', [PrestationController::class, 'suiviPharmacie'])->name('suivi-pharmacie');
    Route::get('/optique/suivi', [PrestationController::class, 'suiviOptique'])->name('suivi-optique');
    Route::get('/dentaire-auditif/suivi', [PrestationController::class, 'suiviDentaireAuditif'])->name('suivi-dentaire-auditif');
    Route::get('/autre/suivi', [PrestationController::class, 'suiviAutre'])->name('suivi-autre');
    Route::get('/all/suivi', action: [PrestationController::class, 'suiviTous'])->name('suivi-all');

    Route::resource('adherents', AdherentController::class);
    Route::get('/envoi-fiche-cession-salaire/{id}', [DemandeController::class, 'envoiFicheCessionSalaire'])
        ->name('adherents.envoi-fiche-cession-salaire');

    Route::get('/adherents-old/update', action: [AdherentController::class, 'oldUpdate'])->name('adherents.old.update');

    Route::resource('ayantsdroits', AyantDroitController::class);
    Route::resource('prestations', PrestationController::class);
    Route::resource('cotisations', CotisationController::class);
    Route::resource('parametres', ParametreController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('partenaires', PartenaireController::class);
    Route::resource('restrictions', RestrictionController::class);
    Route::resource('prestations', PrestationController::class);
    Route::resource('articles', ArticleController::class);

    Route::get('/preview-fiche-cession-volontaire/{id}', [DemandeController::class, 'previewFiche'])->name('preview-fiche-cession-volontaire');
    Route::get('/preview-formulaire-adhesion/{id}', [DemandeController::class, 'previewForm'])->name('preview-formulaire-adhesion');


    //DEBUT COMPTABILITE
    Route::resource('demandes', DemandeController ::class);
    Route::match(['post', 'put'], '/adherents/{id}/accept', [DemandeController::class, 'accept'])->name('adherents.accept');
    Route::resource('recettes', RecetteController ::class);
    Route::get('recettes-categories', [RecetteController ::class, 'categories'])->name('recettes.categories');
    Route::resource('depenses', DepenseController ::class);
    Route::get('depenses-categories', [DepenseController ::class, 'categories'])->name('depenses.categories');
    Route::resource('categories', CategorieController ::class);
    Route::resource('caisse', CaisseController ::class);
    Route::resource('budget-suivi', BudgetController ::class);
    Route::resource('estimations', EstimationeController ::class);

    //FIN COMPTABILITE

    Route::get('/get-data', [CotisationController::class, 'getData']);

    Route::post('/prestations/{id}/valider', [PrestationController::class, 'valider'])->name('prestations.valider');
    Route::post('/prestations/{id}/rejeter', [PrestationController::class, 'rejeter'])->name('prestations.rejeter');
    Route::post('/prestations/{id}/validerpaiement', [PrestationController::class, 'validerPaiement'])->name('prestations.validerpaiement');
});

require __DIR__.'/auth.php';
