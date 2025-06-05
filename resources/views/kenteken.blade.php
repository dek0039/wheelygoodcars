@extends('layouts.app')
@section('content')
<form action="{{ route('kentekencheck') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="kenteken" class="form-label">Kenteken</label>
        <input type="text" name="kenteken" id="kenteken" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Go</button>
</form>
@endsection