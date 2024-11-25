<?php

use App\Http\Controllers\EstimationController;
use App\Livewire\Counter;
use App\Models\AyantDroit;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdherantController;
use App\Http\Controllers\Auth\AdherantAuthenticatedSessionController;
use App\Http\Controllers\Auth\PartenaireAuthenticatedSessionController;
use App\Http\Controllers\Auth\UserLoginDetectorController;
use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\AyantDroitController;
use App\Http\Controllers\ActeMedicalController;
use App\Http\Controllers\BudgetController;

use App\Http\Controllers\CaisseController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EstimationeController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\RestrictionController;
use App\Models\Partenaire;

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
Route::get('/contacts', [AccueilController::class, 'contacts'])->name(name: 'contacts');
Route::get('/services', [AccueilController::class, 'services'])->name(name: 'services');
Route::get('/en-construction', [AccueilController::class, 'enConstruction'])->name(name: 'en-construction');
Route::get('/partenaires/liste', [AccueilController::class, 'partenaires'])->name('liste-partenaires');

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



// Affichage du formulaire de connexion

// Authentification d'un Adhérent
Route::get('/login/adherent', [AdherantAuthenticatedSessionController::class, 'create'])->name('adherent.login');
Route::post('/login/adherent', [AdherantAuthenticatedSessionController::class, 'store']);
Route::post('/logout/adherent', [AdherantAuthenticatedSessionController::class, 'destroy'])
    ->name('adherent.logout')
    ->middleware('auth:adherent');

// Authentification d'un Partenaire
Route::get('/login/partenaire', [PartenaireAuthenticatedSessionController::class, 'create'])->name('partenaire.login');
Route::post('/login/partenaire', [PartenaireAuthenticatedSessionController::class, 'store']);
Route::post('/logout/partenaire', [PartenaireAuthenticatedSessionController::class, 'destroy'])
    ->name('partenaire.logout')
    ->middleware('auth:partenaire');
Route::get('/partenaires/dashboard', [PartenaireAuthenticatedSessionController::class, 'dashboard'])
    ->name('partenaires.dashboard');

// Detection automatique du Controller en fonction du User
Route::get('/login/user', [UserLoginDetectorController::class, 'showLoginForm'])->name('user.login');
Route::post('/login/user', [UserLoginDetectorController::class, 'authenticate']);


Route::get('/partenaires/prestations', [PrestationController::class, 'prestationsPartenaire'])
        ->name('partenaires.prestations');

Route::match(['get', 'post'], '/partenaires/prestations/nouvelle', [PrestationController::class, 'newPrestationPartenaire'])
        ->name('partenaires.nouvelle-prestation');
    
    
Route::post('/partenaire/rechercher-adherent', [PartenaireController::class, 'searchAdherent'])->name('partenaire.searchAdherent');

Route::post('/partenaires/prestations/store', [PrestationController::class, 'storePrestationPartenaire'])
    ->name('partenaires.nouvelle-prestation.store');
Route::resource('restrictions', RestrictionController::class);

Route::middleware('auth:adherent')->group(function () {
    Route::get('/adherents/change-password', [AdherantAuthenticatedSessionController::class, 'showChangePasswordForm'])->name('adherents.change-password');
    Route::post('/adherents/change-password', [AdherantAuthenticatedSessionController::class, 'updatePassword'])->name('adherents.update-password');

    Route::get('/adherents/verify-otp', [AdherantAuthenticatedSessionController::class, 'showVerifyOtpForm'])->name('adherents.verify-otp');
    Route::post('/adherents/verify-otp', [AdherantAuthenticatedSessionController::class, 'verifyOtp']);


    Route::get('/adherents/dashboard', [AdherantAuthenticatedSessionController::class, 'dashboard'])
        ->name('adherents.dashboard');


    Route::get('/adherents/prestations', [PrestationController::class, 'prestations'])
        ->name('adherents.prestations');

    Route::get('/adherents/ayantsdroits', [AyantDroitController::class, 'ayantsDroits'])
        ->name('adherents.ayantsdroits');
    
    Route::get('/adherents/ayantsdroits/nouveau', [AyantDroitController::class, 'newAyantDroitAdherent'])
        ->name('adherents.nouveau-ayantdroit');
    
    Route::post('/adherents/ayantsdroits/store', [AyantDroitController::class, 'storeAyantDroitAdherent'])
        ->name('adherents.nouveau-ayantdroit.store');
    Route::delete('/adherents/ayantsdroits/delete/{id}', [AyantDroitController::class, 'deleteAyantDroitAdherent'])
        ->name('adherents.delete-ayantdroit');
    

    Route::get('/adherents/prestations/nouvelle', [PrestationController::class, 'newPrestationAdherent'])
        ->name('adherents.nouvelle-prestation');

    Route::post('/adherents/prestations/store', [PrestationController::class, 'storePrestationAdherent'])
        ->name('adherents.nouvelle-prestation.store');
    
});
Route::resource('prestations', PrestationController::class);


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
    Route::resource('partenaires', PartenaireController::class);

    //DEBUT COMPTABILITE
    Route::resource('demandes', DemandeController ::class);
    Route::post('/adherents/{id}/accept', [DemandeController::class, 'accept'])->name('adherents.accept');

    Route::resource('recettes', RecetteController ::class);
    Route::get('recettes-categories', [RecetteController ::class, 'categories'])->name('recettes.categories');

    Route::resource('depenses', DepenseController ::class);
    Route::get('depenses-categories', [DepenseController ::class, 'categories'])->name('depenses.categories');
    Route::resource('categories', CategorieController ::class);

    Route::resource('caisse', CaisseController ::class);

    Route::resource('budget-suivi', BudgetController ::class);
    Route::resource('estimations', EstimationeController ::class);


    //FIN COMPTABILITE


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
