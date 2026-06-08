<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//! Homepage pubblica mostra gli ultimi 3 progetti dal database.
Route::get('/', function () {
    // utilizzo --> 'with("type")' per ottimizzare le query (Eager Loading) che evita rallentamenti
    //note L'eager loading è una tecnica di ottimizzazione dei database che permette di caricare i dati correlati (come le tabelle collegate) in un'unica query iniziale, invece di eseguire una query separata per ogni singolo record, problema noto per le N+1

    $projects = Project::with('type')->orderBy('created_at', 'desc')->take(3)->get();

    return view('welcome', compact('projects'));
});

//! Rotta indice pubblico per tutti i progetti 
Route::get('/projects', function () {
    $projects = Project::with('type')->orderBy('created_at', 'desc')->paginate(9);

    return view('guest.projects.index', compact('projects'));
})->name('projects.index');

//! Rotta per il dettaglio del singolo progetto --> visibile da tutti
Route::get('/projects/{slug}', function ($slug) {
    // cerca il progetto tramite lo slug
    $project = Project::where('slug', $slug)->with('type')->firstOrFail();


    return view('guest.projects.show', compact('project'));
})->name('projects.show');


//! redirect automatico basato sul ruolo dell'utente ==> se è admin va alla dashboard altrimenti lo idirizza alla homepage comune(index)
Route::get('/dashboard', function () {

    if (Auth::user()->is_admin) {
        return redirect()->route('admin.index');
    }

    return redirect()->route('projects.index')->with('status', 'Registrazione effettuata con successo!');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// affinché la parola 'admin' funzioni dentro questa Route::middleware(), bisonga aver detto a Laravel a quale classe corrisponde quel soprannome. GUARDA BOOTSTRAP/APP.PHP
Route::middleware(['auth', 'verified', 'admin'])
    ->name('admin.')
    ->prefix("admin")
    ->group(function () {

        Route::get("/", [DashboardController::class, 'index'])
            ->name("index");

        Route::get("/profile", [DashboardController::class, 'profile'])
            ->name("profile");

        Route::resource('projects', ProjectController::class);

        Route::resource('types', TypeController::class);
    });

require __DIR__ . '/auth.php';
