@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<main>
    <div class="container py-5">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Creato il</th>
                <th scope="col">Ultima modifica</th>
              </tr>
            </thead>
            <tbody>
            @forelse($projects as $project)
              <tr>
                <th scope="row">{{ $project->id}}</th>
                <td>{{ $project->title}}</td>
                <td>{{ $project->slug}}</td>
                <td>{{ $project->created_at}}</td>
                <td>{{ $project->updated_at}}</td>
                <td>
                    <a href="{{ route('admin.projects.show', $project)}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6">
                    <h2 class="text-center">Nessun progetto realizzato</h2>
                </td>
              </tr>
                
            @endempty 
        
            @endforelse
            </tbody>
        </table>
    </div>
</main>


@endsection


