@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class=" text-center mt-4">Modifica <strong class="color-date">{{ $project->title }}</strong></h2>
        <div class="row justify-content-center">
            <div class="col-10">
                <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Titolo</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $project->title) }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="type">Categoria</label>
                        <select name="type_id" id="type" class="form-select">
                            <option value="">Nessuna categoria</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @selected($project->type?->id == $type->id)>{{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="cover_image">Immagine</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control">
                        {{-- Preview dell'immagine --}}
                        <div class=" preview-edit mt-3">
                            <img id="image_preview" src="{{ asset('storage/' . $project->cover_image) }}"
                                alt="{{ 'Cover' . $project->title }}">
                        </div>

                    </div>
                    <div class="form-group mb-3">
                        <label for="article">Titolo</label>
                        <textarea name="article" id="article" class="form-control" rows="10">{{ old('article', $project->article) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection
