<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AccueilController;
use App\Http\Controllers\Frontend\AdherantController;
use App\Http\Controllers\Auth\AdherentAuthenticatedSessionController;
use App\Http\Controllers\Auth\PartenaireAuthenticatedSessionController;
use App\Http\Controllers\Auth\UserLoginDetectorController;
use App\Http\Controllers\Frontend\AyantDroitController;
use App\Http\Controllers\Frontend\ActeMedicalController;


use App\Http\Controllers\Frontend\PrestationController;
use App\Http\Controllers\Frontend\PartenaireController;

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
Route::get('/final-demande-adhesion', [AccueilController::class, 'confirmationAdhesion'])->name('final-demande-adhesion');

Route::get('/cession-volontaire/{id}', [AccueilController::class, 'showCessionVolontaire'])->name('showCessionVolontaire');
Route::get('/impression-fiche-cession/{id}', [AccueilController::class, 'imprimerFicheCession'])->name('imprimer-fiche-cession');

Route::get('/login/adherent', [AdherentAuthenticatedSessionController::class, 'create'])->name('adherent.login');
Route::post('/login/adherent', [AdherentAuthenticatedSessionController::class, 'store']);


Route::get('/login/partenaire', [PartenaireAuthenticatedSessionController::class, 'create'])->name('partenaire.login');
Route::post('/login/partenaire', [PartenaireAuthenticatedSessionController::class, 'store']);

// Detection automatique du Controller en fonction du User
Route::get('/login/user', [UserLoginDetectorController::class, 'showLoginForm'])->name('user.login');
Route::post('/login/user', [UserLoginDetectorController::class, 'authenticate']);

Route::middleware('auth:partenaire')->group(function () {
    
    Route::get('/partenaires/dashboard', [PartenaireAuthenticatedSessionController::class, 'dashboard'])
        ->name('partenaires.dashboard');
    Route::get('/partenaire/change-password', [PartenaireAuthenticatedSessionController::class, 'showChangePasswordForm'])->name('partenaire.change-password');
    Route::post('/partenaire/change-password', [PartenaireAuthenticatedSessionController::class, 'updatePassword'])->name('partenaire.update-password');

    Route::get('/partenaires/prestations', [PrestationController::class, 'prestationsPartenaire'])
        ->name('partenaires.prestations');
    
    Route::match(['get', 'post'], '/partenaires/prestations/nouvelle', [PrestationController::class, 'newPrestationPartenaire'])
        ->name('partenaires.nouvelle-prestation');
    
    Route::post('/partenaire/rechercher-adherent', [PartenaireController::class, 'searchAdherent'])->name('partenaire.searchAdherent');
        
    Route::post('/partenaires/prestations/store', [PrestationController::class, 'storePrestationPartenaire'])
        ->name('partenaires.nouvelle-prestation.store');
    Route::post('/logout/partenaire', [PartenaireAuthenticatedSessionController::class, 'destroy'])
        ->name('partenaire.logout');
});


Route::middleware('auth:adherent')->group(function () {
    Route::get('/adherents/change-password', [AdherentAuthenticatedSessionController::class, 'showChangePasswordForm'])->name('adherents.change-password');
    Route::post('/adherents/change-password', [AdherentAuthenticatedSessionController::class, 'updatePassword'])->name('adherents.update-password');

    Route::get('/adherents/verify-otp', [AdherentAuthenticatedSessionController::class, 'showVerifyOtpForm'])->name('adherents.verify-otp');
    Route::post('/adherents/verify-otp', [AdherentAuthenticatedSessionController::class, 'verifyOtp']);


    Route::get('/adherents/dashboard', [AdherentAuthenticatedSessionController::class, 'dashboard'])
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

Route::post('/logout/adherent', [AdherentAuthenticatedSessionController::class, 'destroy'])
    ->name('adherent.logout')
    ->middleware('auth:adherent');





require __DIR__.'/auth.php';
