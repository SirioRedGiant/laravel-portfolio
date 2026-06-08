@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Intestazione della pagina --}}
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-dark mb-3">Il Mio <span class="text-primary">Portfolio</span></h1>
        <p class="lead text-muted max-w-75 mx-auto">
            Esplora l'archivio completo dei miei lavori, dai piccoli esperimenti ai progetti full-stack.
        </p>
    </div>

    {{-- Griglia Progetti --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5">
        @forelse($projects as $project)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm text-decoration-none transition-hover rounded-4 overflow-hidden">

                {{-- Immagine --}}
                @if($project->image)
                {{-- Usa asset('storage/' . $project->image) se le salvi nello storage --}}
                <img src="{{ $project->image }}" class="card-img-top object-fit-cover" alt="{{ $project->title }}" style="height: 200px;">
                @else
                <div class="card-img-top bg-light d-flex justify-content-center align-items-center text-muted" style="height: 200px;">
                    <i class="bi bi-image fs-1"></i>
                </div>
                @endif

                <div class="card-body d-flex flex-column p-4">
                    {{-- Badge Categoria & Tecnologie --}}
                    <div class="mb-3 d-flex flex-wrap gap-2 align-items-center">
                        @if($project->type)
                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            {{ $project->type->name }}
                        </span>
                        @else
                        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">
                            Nessuna categoria
                        </span>
                        @endif

                        {{-- Tecnologie del Progetto --}}
                        @if($project->technologies->isNotEmpty())
                        @foreach($project->technologies as $technology)
                        <span class="badge rounded-pill px-2 py-1 fw-medium"
                            style="background-color: {{ $technology->color . '15' }}; color: {{ $technology->color }}; border: 1px solid {{ $technology->color . '30' }}; font-size: 0.75rem;"
                            title="{{ $technology->name }}">
                            {{ $technology->name }}
                        </span>
                        @endforeach
                        @endif
                    </div>

                    {{-- Titolo e Descrizione --}}
                    <h4 class="card-title fw-bold text-dark">{{ $project->title }}</h4>
                    <p class="card-text text-secondary mb-4 flex-grow-1">
                        {{ Str::limit($project->description ?? 'Nessuna descrizione...', 120) }}
                    </p>

                    {{-- Bottone Dettagli ==> stretched-link fa in modo che l'intera card funzioni come link --}}
                    <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-outline-primary stretched-link rounded-pill">
                        Scopri di più <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <h3 class="text-muted">Nessun progetto trovato.</h3>
        </div>
        @endforelse
    </div>

    {{-- Paginazione => avanti e indietro --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $projects->links() }}
    </div>

</div>

{{-- CSS integrato per gli effetti di hover e transizione --}}
<style>
    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    /* Risolve un bug visivo se si usa Bootstrap 5 con la paginazione di Laravel */
    svg.w-5.h-5 {
        width: 20px;
    }
</style>
@endsection