@extends('layouts.app')

@section('content')

<!-- style="min-height: 100vh;" RICORDA : aggiungi al jumbotron per vedere in funzione il tasto Esplora Progetti   -->
<div class="jumbotron p-5 mb-4 bg-dark text-white rounded-bottom-3 shadow-sm">
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold mb-3">
            Benvenuto nel mio <span class="text-primary">Portfolio</span> <i class="bi bi-briefcase"></i>
        </h1>
        <p class="col-md-8 mx-auto fs-5 text-light">
            Esplora i miei ultimi lavori, scopri le tecnologie che utilizzo e i progetti su cui ho lavorato.
            Sono uno <strong>sviluppatore</strong> appassionato alla ricerca di nuove sfide.
        </p>
        <div class="mt-4">
            <a href="#projects-section" class="btn btn-primary btn-lg me-2">Esplora Progetti</a>
            @auth
            <a href="{{ route('admin.index') }}" class="btn btn-outline-light btn-lg">Vai alla Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Area Riservata</a>
            @endauth
        </div>
    </div>
</div>

<div id="projects-section" class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-secondary">I Miei Ultimi Lavori</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($projects ?? [] as $project)
        <div class="col">
            <div class="card h-100 shadow-sm border-0">

                {{-- <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" alt="{{ $project->title }}"> --}}

                <div class="card-body">
                    <div class="mb-3 d-flex flex-wrap gap-1 align-items-center">
                        {{-- Tipologia/Categoria --}}
                        @if($project->type)
                        <span class="badge bg-info text-dark">{{ $project->type->name }}</span>
                        @else
                        <span class="badge bg-secondary">Nessuna Categoria</span>
                        @endif

                        {{-- 🆕 Tecnologie collegate al progetto --}}
                        @foreach($project->technologies as $technology)
                        <x-technology-badge :technology="$technology" />
                        @endforeach
                    </div>

                    <h5 class="card-title fw-bold">{{ $project->title }}</h5>
                    <p class="card-text text-muted">
                        {{ Str::limit($project->description ?? 'Nessuna descrizione disponibile.', 100) }}
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 pb-3">
                    <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-outline-primary btn-sm w-100">
                        <i class="bi bi-info-circle me-1"></i> Dettagli Progetto
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p class="text-muted fs-5">Non ci sono ancora progetti da mostrare. Torna presto!</p>
        </div>
        @endforelse
    </div>
</div>
<div class="text-center mt-5">
    <a href="{{ route('projects.index') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm hover-scale">
        Esplora Tutto il Portfolio <i class="bi bi-arrow-right ms-2"></i>
    </a>
</div>
</div>
@endsection