@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">🚗 Auto aanbod</h1>

    <form action="" method="GET" class="row mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Zoek op merk of model..." value="{{ request('q') }}">
        </div>
        <div class="col-md-4">
            <select name="tag" class="form-control">
                <option value="">-- Filter op tag --</option>
            
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Zoeken</button>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($cars as $car)
        <div class="col">
            <div class="card h-100 shadow-sm">
                @if($car->image)
                    <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top" alt="Foto van auto">
                @else
                    <img src="https://via.placeholder.com/400x200?text={{ $car->brand }}" class="card-img-top" alt="Placeholder">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                    <p class="card-text">
                        💰 <strong>€{{ number_format($car->price, 0, ',', '.') }}</strong><br>
                        📅 {{ $car->production_year }}<br>
                        🧭 {{ number_format($car->mileage) }} km<br>
                        🎨 {{ ucfirst($car->color) }}
                    </p>
                    <div class="mb-2">
                     
                    </div>
                    <a href="{{ route("details", $car->id)}}" class="btn btn-outline-primary btn-sm">Bekijk</a>
                </div>
            </div>
        </div>
        @empty
            <p>Er zijn momenteel geen auto's beschikbaar.</p>
        @endforelse
    </div>
</div>
@endsection
