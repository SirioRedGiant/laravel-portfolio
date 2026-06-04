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

                <input type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    id="title"
                    name="title"
                    value="{{ old('title') }}">

                @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    name="description"
                    rows="5">{{ old('description') }}
                </textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">URL Immagine di copertina</label>
                <input type="url" class="form-control @error('image') is-invalid @enderror"
                    id="image"
                    name="image"
                    value="{{ old('image') }}">
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="link_github" class="form-label">Link GitHub</label>
                    <input type="url" class="form-control @error('link_github') is-invalid @enderror"
                        id="link_github"
                        name="link_github"
                        value="{{ old('link_github') }}">
                    @error('link_github')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="link_website" class="form-label">Link Sito Live</label>
                    <input type="url" class="form-control @error('link_website') is-invalid @enderror"
                        id="link_website"
                        name="link_website"
                        value="{{ old('link_website') }}">
                    @error('link_website')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
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