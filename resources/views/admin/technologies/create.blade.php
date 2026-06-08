@extends('layouts.admin')

@section('page-title', 'Nuova Tecnologia')

@section('content')
<div class="card p-4">
    <div class="mb-4">
        <h3>Crea Nuova Tecnologia</h3>
        <p class="text-muted">Inserisci il nome e scegli il colore per il badge della tecnologia.</p>
    </div>

    <form action="{{ route('admin.technologies.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="form-label fw-bold">Nome della Tecnologia *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Es. Laravel, Vue.js, MySQL...">

            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="color" class="form-label fw-bold">Colore del Badge</label>
            <div class="d-flex align-items-center gap-3">
                <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', '#6c757d') }}" title="Scegli il colore">
                <span class="text-muted small">Seleziona il colore principale che verrà usato per creare il badge.</span>
            </div>

            @error('color')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="bi bi-save me-1"></i> Salva Tecnologia
            </button>
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-outline-secondary btn-sm">
                Annulla
            </a>
        </div>
    </form>
</div>
@endsection