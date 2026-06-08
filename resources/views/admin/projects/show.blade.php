@extends('layouts.admin')

@section('page-title', $project->title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Torna alla lista
        </a>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning btn-sm text-dark">
                <i class="bi bi-pencil me-1"></i> Modifica Progetto
            </a>

            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModalShow">
                <i class="bi bi-trash me-1"></i> Elimina
            </button>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="row g-0">
            @if($project->image)
            <div class="col-md-4">
                <img src="{{ $project->image }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $project->title }}">
            </div>
            @endif
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title text-primary">{{ $project->title }}</h2>
                    <p class="text-muted mb-4"><strong>Slug:</strong> {{ $project->slug }}</p>

                    <p class="mb-4">
                        <strong>Tipologia:</strong>
                        @if($project->type)
                        <span class="badge bg-secondary text-white">{{ $project->type->name }}</span>
                        @else
                        <span class="badge bg-light text-dark">Nessuna tipologia</span>
                        @endif
                    </p>

                    <p class="mb-4">
                        <strong>Tecnologie:</strong>
                        @if($project->technologies && $project->technologies->count() > 0)
                        @foreach($project->technologies as $technology)

                        <x-technology-badge :technology="$technology" />

                        @endforeach
                        @else
                        <span class="badge bg-light text-dark">Nessuna tecnologia</span>
                        @endif
                    </p>

                    <h5>Descrizione del Progetto:</h5>
                    <p class="card-text text-secondary" style="white-space: pre-line;">
                        {{ $project->description ?? 'Nessuna descrizione fornita per questo progetto.' }}
                    </p>

                    <div class="mt-4">
                        @if($project->link_github)
                        <a href="{{ $project->link_github }}" target="_blank" class="btn btn-dark me-2">
                            <i class="bi bi-github"></i> Repository GitHub
                        </a>
                        @endif

                        @if($project->link_website)
                        <a href="{{ $project->link_website }}" target="_blank" class="btn btn-success">
                            <i class="bi bi-globe"></i> Sito Live
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModalShow" tabindex="-1" aria-labelledby="deleteModalShowLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalShowLabel">Conferma Eliminazione</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                Sei sicuro di voler eliminare definitivamente il progetto <strong>{{ $project->title }}</strong>? Verrai reindirizzato alla lista generale.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sì, elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection