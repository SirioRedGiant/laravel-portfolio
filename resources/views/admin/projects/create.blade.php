@extends('layouts.admin')

@section('page-title', 'Aggiungi Nuovo Progetto')

@section('content')
<div class="container-fluid">
    <div class="card p-4 shadow-sm">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo del Progetto *</label>
                <input type="text" class="form-control" id="title" name="title" required value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">URL Immagine di copertina</label>
                <input type="url" class="form-control" id="image" name="image" value="{{ old('image') }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="link_github" class="form-label">Link GitHub</label>
                    <input type="url" class="form-control" id="link_github" name="link_github" value="{{ old('link_github') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="link_website" class="form-label">Link Sito Live</label>
                    <input type="url" class="form-control" id="link_website" name="link_website" value="{{ old('link_website') }}">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Salva Progetto</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Annulla</a>
            </div>
        </form>
    </div>
</div>
@endsection