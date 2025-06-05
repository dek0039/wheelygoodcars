@extends('layouts.app')

@section('content')
<h2 class="mb-4">Mijn Geplaatste Auto's</h2>

@if (session('success'))
<div style="color: green;">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
    <thead>
        <tr>
            <th>Merk</th>
            <th>Model</th>
            <th>Kenteken</th>
            <th>Bouwjaar</th>
            <th>Kilometers</th>
            <th>Prijs (€)</th>
            <th>Kleur</th>
            <th>Status</th>
            <th>Acties</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cars as $car)
        <tr>
            <td>{{ $car->brand }}</td>
            <td>{{ $car->model }}</td>
            <td>{{ $car->license_plate }}</td>
            <td>{{ $car->production_year }}</td>
            <td>{{ $car->mileage }} km</td>
            <td>{{ number_format($car->price, 2, ',', '.') }}</td>
            <td>{{ $car->color }}</td>
            <td>
                @if($car->sold_at)
                Verkocht
                @else
                Te koop
                @endif
            </td>
            <td>
                <form action="{{ route('toggle', $car->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">
                        {{ $car->sold_at ? 'Markeer als niet-verkocht' : 'Markeer als verkocht' }}
                    </button>
                </form>

                <form action="{{ route('delete', $car->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('Weet je zeker dat je deze auto wilt verwijderen?')">
                        Verwijder
                    </button>
                </form>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">Je hebt nog geen auto's geplaatst.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection