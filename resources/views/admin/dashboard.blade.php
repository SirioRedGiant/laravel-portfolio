@extends('layouts.admin')

@section('page-title', 'Dashboard Amministratore')

@section('content')
<div class="container-fluid">

    {{-- Banner di Benvenuto --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 p-3 bg-white">
                <div class="card-body">
                    <h4 class="fw-bold text-primary mb-1">
                        Benvenuto, {{ Auth::user()->name }}! 👋
                    </h4>
                    <p class="mb-0 text-muted">
                        Qui puoi monitorare e gestire l'intero portfolio. Ecco la situazione attuale:
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Riga dei Contatori (3 colonne) --}}
    <div class="row g-4 mb-4">
        {{-- Contatore Progetti --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold">Totale Progetti</h6>
                        <h2 class="fw-bold text-primary mb-0">{{ $projectsCount }}</h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                        <i class="bi bi-journal-code fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contatore Tipologie --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold">Totale Tipologie</h6>
                        <h2 class="fw-bold text-success mb-0">{{ $typesCount }}</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                        <i class="bi bi-tags fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contatore Tecnologie --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold">Totale Tecnologie</h6>
                        <h2 class="fw-bold text-info mb-0">{{ $technologiesCount }}</h2>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle text-info">
                        <i class="bi bi-cpu fs-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Cards --}}
    <div class="row g-4">
        {{-- Card Progetti --}}
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm h-100 p-3 text-center border-0">
                <div class="card-body d-flex flex-column justify-content-center">
                    <i class="bi bi-folder-symlink display-5 mb-3"></i>
                    <h5 class="card-title fw-bold">Gestione Progetti</h5>
                    <p class="card-text opacity-75">Aggiungi nuovi lavori o modifica quelli esistenti nella tabella.</p>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-light mt-auto text-primary fw-bold btn-sm">
                        Apri i Progetti
                    </a>
                </div>
            </div>
        </div>

        {{-- Card Tipologie --}}
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm h-100 p-3 text-center border-0">
                <div class="card-body d-flex flex-column justify-content-center">
                    <i class="bi bi-tags-fill display-5 mb-3"></i>
                    <h5 class="card-title fw-bold">Gestione Tipologie</h5>
                    <p class="card-text opacity-75">Crea o edita le categorie professionali (Front-End, Back-End...).</p>
                    <a href="{{ route('admin.types.index') }}" class="btn btn-light mt-auto text-success fw-bold btn-sm">
                        Apri le Tipologie
                    </a>
                </div>
            </div>
        </div>

        {{-- Card Tecnologie --}}
        <div class="col-md-4">
            <div class="card bg-info text-white shadow-sm h-100 p-3 text-center border-0">
                <div class="card-body d-flex flex-column justify-content-center">
                    <i class="bi bi-cpu display-5 mb-3"></i>
                    <h5 class="card-title fw-bold">Gestione Tecnologie</h5>
                    <p class="card-text opacity-75">Crea, edita o rimuovi i singoli linguaggi e framework (Laravel, Vue...).</p>
                    <a href="{{ route('admin.technologies.index') }}" class="btn btn-light mt-auto text-info fw-bold btn-sm">
                        Apri le Tecnologie
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection