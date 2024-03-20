@if($project->exists)
<form action="{{route('admin.projects.update', $project->id)}}" method="POST">
    @method('PUT')
@else
<form action="{{route('admin.projects.store')}}" method="POST">
@endif
@csrf
    <div class="row">
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
                <input type="text" class="form-control" id="slug" value="{{ Str::slug(old('title', $project->title)) }}" disabled>
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
        <div class="col-12 d-flex justify-content-end">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_completed" name="is_completed" value="1"
                @if (old('is_completed', $project->is_completed)) checked @endif>
                <label class="form-check-label" for="is_completed">
                    Completato
                </label>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between my-5">
            <a href="{{route('admin.projects.index')}}" class="btn btn-primary"><i class="fa-solid fa-left-long me-2"></i>Torna indietro</a>
            <div class="d-flex gap-2">
                <button class="btn btn-secondary"><i class="fas fa-eraser me-2"></i>Cancella</button>
                <button class="btn btn-success"><i class="fa-solid fa-plus me-2"></i>Conferma</button>
            </div>
        </div>
    </div>
</form>

