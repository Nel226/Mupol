<?php

use App\Livewire\Counter;
use App\Models\AyantDroit;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdherantController;
use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\AyantDroitController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\PrestationController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/counter', Counter::class);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/import-csv', [CsvImportController::class, 'import'])->name('import-csv');
    Route::post('/ayantdroits/import', [AyantDroitController::class, 'import'])->name('ayantdroits.import');

    Route::get('/prestations/{id}/recu', [PrestationController::class, 'downloadReceipt'])->name('prestations.downloadReceipt');
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
