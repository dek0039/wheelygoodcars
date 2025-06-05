<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Car;
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

Route::get('/', function () {
    $cars = Car::whereNull('sold_at')->latest()->paginate(12);
    return view('home', compact("cars"));
})->name('home');

Route::get("/details/{id}", function($id) {
    $car = Car::findOrFail($id);
    return view("car", compact("car"));
})->name("details");

Route::middleware('auth')->group(function () {
    Route::get('/kenteken', function() {
        return view('kenteken');
    })->name('kenteken');


    Route::post('/kentekencheck', function(Request $request) {
        $kenteken = strtoupper(str_replace(' ', '', $request->input('kenteken'))); 
    
        $response = Http::get("https://opendata.rdw.nl/resource/m9d7-ebf2.json", [
            'kenteken' => $kenteken
        ]);
    
        if ($response->successful()) {
            $vehicleData = $response->json();
    
            return view('create', [
                'kenteken' => $kenteken,
                'vehicleData' => $vehicleData[0] ?? null 
            ]);
        } else {
            return back()->with('error', 'Er is een fout opgetreden bij het ophalen van de gegevens.');
        }
    })->name('kentekencheck');

    Route::post("/create", [CarController::class, "create"])->name("create");

    Route::get("/mycars", [CarController::class, "mycars"])->name("mycars");

    Route::post("/delete/{id}", [CarController::class, "delete"])->name("delete");
    Route::post("/toggle/{id}", [CarController::class, "toggle"])->name("toggle");
});

require __DIR__.'/auth.php';
