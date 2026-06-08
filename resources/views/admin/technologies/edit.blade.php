@extends('layouts.admin')

@section('page-title', 'Modifica Tecnologia')

@section('content')
<div class="card p-4">
    <div class="mb-4">
        <h3>Modifica Tecnologia: {{ $technology->name }}</h3>
        <p class="text-muted">Aggiorna il nome e/o il colore della tecnologia selezionata.</p>
    </div>

    <form action="{{ route('admin.technologies.update', $technology) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="form-label fw-bold">Nome della Tecnologia *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $technology->name) }}">

            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="color" class="form-label fw-bold">Colore del Badge</label>
            <div class="d-flex align-items-center gap-3">
                <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', $technology->color) }}" title="Scegli il colore">
                <span class="text-muted small">Modifica il colore per aggiornare l'aspetto dei badge in tutto il sito.</span>
            </div>

            @error('color')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning btn-sm text-dark">
                <i class="bi bi-arrow-clockwise me-1"></i> Aggiorna Tecnologia
            </button>
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-outline-secondary btn-sm">
                Annulla
            </a>
        </div>
    </form>
</div>
@endsection