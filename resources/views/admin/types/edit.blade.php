@extends('layouts.admin')

@section('page-title', 'Modifica Tipologia')

@section('content')
<div class="card p-4">
    <div class="mb-4">
        <h3>Modifica Tipologia: {{ $type->name }}</h3>
        <p class="text-muted">Aggiorna il nome della categoria selezionata.</p>
    </div>

    <form action="{{ route('admin.types.update', $type) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="form-label fw-bold">Nome della Tipologia *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $type->name) }}">

            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning btn-sm text-dark">
                <i class="bi bi-arrow-clockwise me-1"></i> Aggiorna Tipologia
            </button>
            <a href="{{ route('admin.types.index') }}" class="btn btn-outline-secondary btn-sm">
                Annulla
            </a>
        </div>
    </form>
</div>
@endsection