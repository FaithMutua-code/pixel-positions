<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Models\Job;

Route::get('/', [JobController::class, 'index']);
Route::get('/careers',function(){
    return view('careers.index');
});
Route::get('/salaries',function(){
    $query = Job::query();

    if (filled(request('salary_min'))) {
        $query->where('salary_max', '>=', request('salary_min'));
    }

    if (filled(request('salary_max'))) {
        $query->where('salary_min', '<=', request('salary_max'));
    }

    return view('salaries.index', [
        'jobs' => $query->get(),
    ]);
});
Route::get('/companies',function(){
    return view('companies.index');
});
Route::middleware('auth')->group(function(){
  Route::get('/profile', [ProfileController::class, 'edit']);
Route::patch('/profile', [ProfileController::class, 'update']);
  Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store']);
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
Route::get('/jobs/{job}/edit',[JobController::class,'edit'])->name('jobs.edit');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
}); 


Route::get('/search',SearchController::class);
Route::get('/tags/{tag}',TagController::class)->name('tags.show');

Route::middleware('guest')->group(function(){
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);


Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
});

Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');