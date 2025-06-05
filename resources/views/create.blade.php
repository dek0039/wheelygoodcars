@extends('layouts.app')
@section('content')
<h1>Invoeren Voertuiggegevens voor Kenteken: {{ $kenteken }}</h1>

@if($vehicleData)
<form action="{{ route("create") }}" method="POST">
    @csrf

    <input type="hidden" name="license_plate" value="{{ $kenteken }}">

    <label>Merk:</label>
    <input type="text" name="brand" value="{{ $vehicleData['merk'] ?? '' }}" readonly><br>

    <label>Model (Handelsbenaming):</label>
    <input type="text" name="model" value="{{ $vehicleData['handelsbenaming'] ?? '' }}" readonly><br>

    <label>Bouwjaar:</label>
    <input type="text" name="production_year" value="{{ \Carbon\Carbon::parse($vehicleData['datum_eerste_toelating'])->format('Y') ?? '' }}" readonly><br>

    <label>Gewicht (kg):</label>
    <input type="text" name="weight" value="{{ $vehicleData['massa_ledig_voertuig'] ?? '' }}" readonly><br>

    <label>Aantal Deuren:</label>
    <input type="text" name="doors" value="{{ $vehicleData['aantal_deuren'] ?? '' }}" readonly><br>

    <label>Kleur:</label>
    <input type="text" name="color" value="{{ $vehicleData['eerste_kleur'] ?? '' }}" readonly><br>

    <label>Kilometerstand:</label>
    <input type="number" name="mileage" required min="0"><br>

    <label>Vraagprijs (€):</label>
    <input type="number" name="price" required min="0"><br>

    <button type="submit">Opslaan</button>
</form>
@else
<p>Geen voertuiggegevens gevonden voor kenteken {{ $kenteken }}</p>
@endif
@endsection