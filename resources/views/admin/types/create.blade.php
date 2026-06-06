@extends('layouts.admin')

@section('page-title', 'Nuova Tipologia')

@section('content')
<div class="card p-4">
    <div class="mb-4">
        <h3>Crea Nuova Tipologia</h3>
        <p class="text-muted">Inserisci il nome per una nuova categoria di progetti.</p>
    </div>

    <form action="{{ route('admin.types.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="form-label fw-bold">Nome della Tipologia *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Es. Full-Stack, Mobile App, Cyber Security...">

            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="bi bi-save me-1"></i> Salva Tipologia
            </button>
            <a href="{{ route('admin.types.index') }}" class="btn btn-outline-secondary btn-sm">
                Annulla
            </a>
        </div>
    </form>
</div>
@endsection