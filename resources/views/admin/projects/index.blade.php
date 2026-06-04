@extends('layouts.admin')

@section('page-title', 'I Miei Progetti')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Lista Progetti</h3>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Aggiungi Progetto
        </a>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col" style="width: 50px;">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Slug</th>
                <th scope="col" style="width: 150px;">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td><strong>{{ $project->title }}</strong></td>
                <td><code class="text-muted">{{ $project->slug }}</code></td>
                <td>
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-info btn-sm text-white d-inline-flex align-items-center">
                            <i class="bi bi-eye me-1"></i> Mostra
                        </a>

                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning btn-sm text-dark d-inline-flex align-items-center">
                            <i class="bi bi-pencil me-1"></i> Modifica
                        </a>

                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare definitivamente questo progetto?');" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $project->id }}">
                                <i class="bi bi-trash me-1"></i> Elimina
                            </button>
                    </div>

                    <div class="modal fade" id="deleteModal-{{ $project->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $project->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel-{{ $project->id }}">Conferma procedura d'eliminazione</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    Sei sicuro di voler eliminare definitivamente questo progetto: <strong>{{ $project->title }}</strong>? Questa operazione è irreversibile.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annulla</button>

                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Elimina Definitivamente</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection