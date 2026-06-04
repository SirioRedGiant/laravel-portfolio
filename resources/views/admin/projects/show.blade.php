@extends('layouts.admin')

@section('page-title', $project->title)

@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Torna alla lista
        </a>
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
@endsection