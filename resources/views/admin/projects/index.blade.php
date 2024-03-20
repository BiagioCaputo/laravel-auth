{{--Layout--}}
@extends('layouts.app')

{{--Titolo--}}
@section('title', 'Projects')

{{--Contenuto principale pagina--}}
@section('content')

<header>
    <h1 class="text-center my-5">Progetti realizzati</h1>
</header>

<main>
    <div class="container py-5">
        <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Creato il</th>
                <th scope="col">Ultima modifica</th>
                <th scope="col">
                  <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.projects.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus me-1"></i>Nuovo</a>
                    <a href="{{ route('admin.projects.trash')}}" class="btn btn-secondary btn-sm"><i class="fas fa-trash me-1 text-danger"></i>Cestino</a>
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
            @forelse($projects as $project)
              <tr>
                <th scope="row">{{ $project->id}}</th>
                <td>{{ $project->title}}</td>
                <td>{{ $project->slug}}</td>
                <td>{{ $project->getFormattedDate('created_at')}}</td>
                <td>{{ $project->getFormattedDate('updated_at')}}</td>
                <td class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.projects.show', $project)}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.projects.edit', $project)}}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
                    <form action="{{route('admin.projects.destroy', $project)}}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                    <h2 class="text-center">Nessun progetto realizzato</h2>
                </td>
              </tr> 
        
            @endforelse
            </tbody>
        </table>
        {{-- Paginazione --}}
        @if ($projects->hasPages())
        {{ $projects->links()}}
        @endif
    </div>
</main>

@endsection

{{--Scripts--}}
@section('scripts')
    @vite('resources/js/delete_confirmation.js')
    @vite('resources/js/toast_timer.js')
@endsection


