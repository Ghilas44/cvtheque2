<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\{
    CompetenceController,
    CvthequeController,
    MetierController,
    ProfessionnelController
};
use App\Models\Competence;

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
//     // return view('welcome');
//     // return view('cvtheque');

// });

Route::get('/',[CvthequeController::class, 'index'])->name('Accueil');
Route::get('/competences/supprimer/{competence}',[CompetenceController::class, 'formDelete'])->name('DeleteSkill');
Route::get('/metiers/supprimer/{metier}',[MetierController::class, 'formDelete'])->name('DeleteJob');
Route::get('/professionnels/supprimer/{professionnel}',[ProfessionnelController::class, 'formDelete'])->name('professionnels.delete');
Route::get('/metier/{slug}/professionnels',[ProfessionnelController::class, 'index'])->name('professionnels.metier');

Route::resource('competences', CompetenceController::class);
Route::resource('metiers', MetierController::class);
Route::resource('professionnels', ProfessionnelController::class);

