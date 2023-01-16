@extends('layouts.admin')

@section('content')
    <div class="container position-relative">
        <h2 class="text-center mt-4">Lista dei miei progetti</h2>
        <a class="btn btn-success pos-ab" href="{{ route('admin.projects.create') }}">New</a>
        <div class="row justify-content-center mt-5">
            <div class="col-10">
                {{-- Messaggio di avviso creazione progetto --}}
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Titolo</th>
                                <th scope="col">Data di creazione</th>
                                <th scope="col">Immagine</th>
                                <th scope="col">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <th scope="row">{{ $project->title }}</th>
                                    <td>{{ $project->created_at }}</td>
                                    <td>
                                        <div class="cover-img">
                                            @if ($project->cover_image)
                                                <img src="{{ asset('storage/' . $project->cover_image) }}"
                                                    alt="{{ $project->title }}">
                                            @else
                                                <div class="not-image text-center">Not image!</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-success"
                                                href="{{ route('admin.projects.show', $project->slug) }}">
                                                View
                                            </a>
                                            <a class="btn btn-warning ms-2"
                                                href="{{ route('admin.projects.edit', $project->slug) }}">Edit</a>

                                            <button type="button" class="btn btn-danger ms-4" data-bs-toggle="modal"
                                                data-bs-target="#delete-project-{{ $project->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                            {{-- Modal --}}

                                            <div class="modal fade" id="delete-project-{{ $project->id }}" tabindex="-1"
                                                aria-labelledby="delete-label-{{ $project->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title fs-5"
                                                                id="delete-label-{{ $project->id }}">
                                                                Vuoi
                                                                cancellare {{ $project->title }}?</h3>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annulla</button>
                                                            <form
                                                                action="{{ route('admin.projects.destroy', $project->slug) }}"
                                                                method="POST" class="d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit">
                                                                    Cancella
                                                                </button>
                                                            </form>
                                                        </div>
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
            </div>
        </div>
    </div>
@endsection
