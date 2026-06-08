@extends('layouts.admin')

@section('page-title', 'Gestione Tecnologie')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Lista Tecnologie</h3>
        <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Aggiungi Tecnologia
        </a>
    </div>

    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col" style="width: 50px;">ID</th>
                <th scope="col">Nome Tecnologia</th>
                <th scope="col">Anteprima Badge</th>
                <th scope="col">Slug</th>
                <th scope="col" style="width: 150px;">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($technologies as $technology)
            <tr>
                <td>{{ $technology->id }}</td>
                <td><strong>{{ $technology->name }}</strong></td>
                <td>
                    <span class="badge rounded-pill px-3 py-2" style="background-color: {{ $technology->color }}15; color: {{ $technology->color }}; border: 1px solid {{ $technology->color }}30;">
                        {{ $technology->name }}
                    </span>
                </td>
                <td><code class="text-muted">{{ $technology->slug }}</code></td>
                <td>
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-warning btn-sm text-dark d-inline-flex align-items-center">
                            <i class="bi bi-pencil me-1"></i> Modifica
                        </a>

                        <button type="button" class="btn btn-danger btn-sm d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $technology->id }}">
                            <i class="bi bi-trash me-1"></i> Elimina
                        </button>
                    </div>

                    <div class="modal fade" id="deleteModal-{{ $technology->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $technology->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel-{{ $technology->id }}">Conferma eliminazione tecnologia</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start text-dark">
                                    Sei sicuro di voler eliminare definitivamente la tecnologia: <strong>{{ $technology->name }}</strong>? <br>
                                    <span class="text-danger-custom"><strong>Attenzione:</strong> La tecnologia verrà rimossa da tutti i progetti a cui è attualmente assegnata.</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annulla</button>

                                    <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST" class="m-0">
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