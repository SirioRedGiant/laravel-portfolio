@extends('layouts.app')

@section('content')
<div class="container py-5 flex-column">
    <div class="d-flex justify-content-between align-items-center mb-4">

        <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 shadow-sm transition-hover">
            <i class="bi bi-grid-3x3-gap me-2"></i> Torna ai Progetti
        </a>

        <a href="{{ url('/') }}" class="btn btn-outline-warning btn-sm rounded-pill px-4 shadow-sm transition-hover">
            <i class="bi bi-house-door me-1"></i> Home Page
        </a>
    </div>

    <div class="card shadow border-0 overflow-hidden rounded-4">
        <div class="row g-0">

            {{-- Sezione Immagine di Copertina --}}
            @if($project->image)
            <div class="col-lg-5 position-relative bg-light" style="min-height: 300px;">
                {{-- NOTA: Se le immagini sono caricate tramite form, usa: asset('storage/' . $project->image) --}}
                <img src="{{ $project->image }}" class="w-100 h-100 object-fit-cover position-absolute start-0 top-0" alt="{{ $project->title }}">
            </div>
            @endif

            {{-- Sezione Contenuti Text --}}
            <div class="{{ $project->image ? 'col-lg-7' : 'col-12' }}">
                <div class="card-body p-4 p-md-5 d-flex flex-column h-100 justify-content-between">
                    <div>
                        {{-- Tipologia --}}
                        <div class="mb-3">
                            @if($project->type)
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 fs-7">
                                <i class="bi bi-tag-fill me-1"></i> {{ $project->type->name }}
                            </span>
                            @else
                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2 fs-7">
                                Nessuna Tipologia
                            </span>
                            @endif
                            {{-- per separare se ci sono sia tipo che tecnologie --}}
                            @if($project->type && $project->technologies->isNotEmpty())
                            <span class="text-muted mx-1">|</span>
                            @endif

                            {{-- Elenco Tecnologie --}}
                            @if($project->technologies->isNotEmpty())
                            @foreach($project->technologies as $technology)
                            <x-technology-badge :technology="$technology" />
                            @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Titolo --}}
                    <h1 class="display-6 fw-bold text-dark mb-3">{{ $project->title }}</h1>

                    {{-- Descrizione --}}
                    <h5 class="text-muted fw-semibold mt-4 mb-2">Informazioni sul progetto</h5>
                    <p class="card-text text-secondary lh-lg" style="white-space: pre-line;">
                        {{ $project->description ?? 'Nessuna descrizione fornita per questo progetto.' }}
                    </p>
                </div>

                {{-- Link Esterni (GitHub / Sito Web) --}}
                <div class="mt-5 pt-3 border-top d-flex flex-wrap gap-2">
                    @if($project->link_github)
                    <a href="{{ $project->link_github }}" target="_blank" class="btn btn-dark btn-sm rounded-pill px-4 py-2">
                        <i class="bi bi-github me-2"></i> Vedi Repository
                    </a>
                    @endif

                    @if($project->link_website)
                    <a href="{{ $project->link_website }}" target="_blank" class="btn btn-success btn-sm rounded-pill px-4 py-2">
                        <i class="bi bi-globe me-2"></i> Visita il Sito
                    </a>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>
</div>
@endsection