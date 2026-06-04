@extends('layouts.admin')

@section('page-title', 'I Miei Progetti')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Lista Progetti</h3>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">Aggiungi Progetto</a>
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
                    <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-info btn-sm text-white">
                        <i class="bi bi-eye"></i> Vedi
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection