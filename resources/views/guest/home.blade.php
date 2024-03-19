@extends('layouts.app')
@section('title', 'Home')


@section('content')

<header>
    <h1 class="text-center my-5">Benvenuti! Questi sono i miei progetti</h1>
</header>
<main>
    <div class="container py-5">
        <div class="row">
            @forelse($projects as $project)
            <div class="col-4">
                <div class="card my-5" >
                    @if($project->image)
                    <img src="{{$project->image}}" class="card-img-top" alt="{{$project->title}}">
                    @endif
                    <div class="card-body">
                    <h5 class="card-title">{{$project->title}}</h5>
                    <p class="card-text">{{$project->description}}</p>
                    </div>
                </div>
            </div>
            
        
            @empty
            <div class="col-8">
                <h1 class="text-center">Attualmente non ci sono progetti....</h1>
            </div>
            @endforelse

        <div>
            {{-- Paginazione --}}
        @if ($projects->hasPages())
        {{ $projects->links()}}
        @endif
    </div>
</main>



@endsection