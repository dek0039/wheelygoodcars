<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function kentekencheck(Request $request)
    {
        $request->validate([
            'kenteken' => 'required|string|max:255',
        ]);

        return view("create", ['get', $request->kenteken]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'price' => 'required|numeric',
            'mileage' => 'required|integer',
            'doors' => 'nullable|integer',
            'production_year' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'color' => 'nullable|string',
        ]);

        $car = new Car();
        $car->user_id = Auth::id();
        $car->license_plate = $validated['license_plate'];
        $car->brand = $validated['brand'];
        $car->model = $validated['model'];
        $car->price = $validated['price'];
        $car->mileage = $validated['mileage'];
        $car->seats = null;
        $car->doors = $validated['doors'] ?? null;
        $car->production_year = $validated['production_year'] ?? null;
        $car->weight = $validated['weight'] ?? null;
        $car->color = $validated['color'] ?? null;
        $car->image = null;
        $car->sold_at = null;
        $car->views = 0;
        $car->save();

        // return redirect()->route('dashboard')->with('success', 'Auto succesvol opgeslagen!');
    }

    public function mycars()
    {
        $cars = Auth::user()->cars;
        return view('mycars', compact('cars'));
    }

    public function delete($id)
    {
        $car = Car::findOrFail($id);
    
        if ($car->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $car->delete();
    
        return back()->with('success', 'Auto succesvol verwijderd.');
    }
    
    public function toggle($id)
    {
        $car = Car::findOrFail($id);
    
        if ($car->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $car->sold_at = $car->sold_at ? null : now();
        $car->save();
    
        return back()->with('success', 'Verkoopstatus bijgewerkt.');
    }
}
