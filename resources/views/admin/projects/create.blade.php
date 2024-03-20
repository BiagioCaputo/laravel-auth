@extends('layouts.app')

@section('title', 'Projects')

@section('content')

<header>
    <h1 class="text-center my-5">Nuovo Progetto</h1>
</header>
<main>
    <div class="container py-5">
        <form action="{{route('admin.projects.store')}}" method="POST">
            <div class="row">
                @csrf
                <div class="col-6">
                    <div class="mb-4">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @elseif(old('title', '')) is-valid  @enderror" id="title" name="title" placeholder="Nome progetto" value="{{old('title', $project->title)}}">
                        @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-4">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" disabled>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-5">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control @error('description') is-invalid @elseif(old('description', '')) is-valid @enderror" id="description" name="description" rows="8">
                            {{old('description', $project->description)}}
                        </textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-7">
                    <div class="mb-5">
                        <label for="image" class="form-label">Immagine</label>
                        <input class="form-control @error('image') is-invalid @elseif(old('image', '')) is-valid @enderror" id="image" name="image"  placeholder="http:// o https://" value="{{old('image', $project->image)}}">
                        @error('image')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-1">
                    <div class="mb-5">
                        <img src="https://marcolanci.it/boolean/assets/placeholder.png" class="img-fluid" alt="img-post" id="preview">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between my-5">
                    <a href="{{route('admin.projects.index')}}" class="btn btn-primary"><i class="fa-solid fa-left-long me-2"></i>Torna indietro</a>
                    <div class="d-flex gap-2">
                        <button class="btn btn-secondary"><i class="fas fa-eraser me-2"></i>Cancella</button>
                        <button class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Aggiungi</button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</main>



@endsection

@section('scripts')

@endsection

