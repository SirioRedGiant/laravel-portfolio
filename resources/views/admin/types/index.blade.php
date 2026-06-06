@extends('layouts.admin')

@section('page-title', 'Gestione Tipologie')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Lista Tipologie</h3>
        <a href="{{ route('admin.types.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Aggiungi Tipologia
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
                <th scope="col">Nome Tipologia</th>
                <th scope="col">Slug</th>
                <th scope="col" style="width: 150px;">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
            <tr>
                <td>{{ $type->id }}</td>
                <td><strong>{{ $type->name }}</strong></td>
                <td><code class="text-muted">{{ $type->slug }}</code></td>
                <td>
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-warning btn-sm text-dark d-inline-flex align-items-center">
                            <i class="bi bi-pencil me-1"></i> Modifica
                        </a>

                        <button type="button" class="btn btn-danger btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $type->id }}">
                            <i class="bi bi-trash me-1"></i> Elimina
                        </button>
                    </div>

                    <div class="modal fade" id="deleteModal-{{ $type->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $type->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel-{{ $type->id }}">Conferma eliminazione tipologia</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start text-dark">
                                    Sei sicuro di voler eliminare definitivamente la tipologia: <strong>{{ $type->name }}</strong>? <br>
                                    <span class="text-danger-custom"><strong>Attenzione:</strong> I progetti associati a questa tipologia rimarranno senza categoria.</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annulla</button>

                                    <form action="{{ route('admin.types.destroy', $type) }}" method="POST" class="m-0">
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