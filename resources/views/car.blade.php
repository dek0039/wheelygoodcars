@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="row no-gutters">
            <div class="col-md-6">
                @if($car->image)
                    <img src="{{ asset('storage/' . $car->image) }}" class="img-fluid rounded-start" alt="Auto afbeelding">
                @else
                    <img src="https://via.placeholder.com/600x400?text=Geen+afbeelding" class="img-fluid rounded-start" alt="Geen afbeelding">
                @endif
            </div>

            <div class="col-md-6">
                <div class="card-body">
                    <h3 class="card-title">{{ $car->brand }} {{ $car->model }}</h3>
                    <h5 class="text-muted">€{{ number_format($car->price, 2, ',', '.') }}</h5>
                    <p><strong>Kenteken:</strong> {{ $car->license_plate }}</p>
                    <p><strong>Kilometerstand:</strong> {{ number_format($car->mileage) }} km</p>
                    <p><strong>Productiejaar:</strong> {{ $car->production_year }}</p>
                    <p><strong>Gewicht:</strong> {{ $car->weight ? $car->weight . ' kg' : '-' }}</p>
                    <p><strong>Deuren:</strong> {{ $car->doors ?? '-' }}</p>
                    <p><strong>Kleur:</strong> {{ ucfirst($car->color) ?? '-' }}</p>
                    <p><strong>Stoelen:</strong> {{ $car->seats ?? '-' }}</p>
                    <p><strong>Views:</strong> {{ $car->views }}</p>

                    @if($car->sold_at)
                        <div class="alert alert-danger mt-3">Deze auto is verkocht.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="viewsToast" class="toast bg-info text-white" role="alert" data-bs-delay="5000">
        <div class="toast-body">
            {{ $car->views }} mensen bekeken deze auto vandaag.
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    setTimeout(() => {
        var toastEl = document.getElementById('viewsToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    }, 10000);
</script>
@endsection
