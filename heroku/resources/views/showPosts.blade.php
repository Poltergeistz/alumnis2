@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-5">
  <div class="card-body">
    <h5 class="card-title">{{ $post->title }}
    @foreach($post->categories as $category)
     <span class="badge badge-primary">{{$category->name}}</span>
     @endforeach
     </h5>
    <p class="card-text">{{ $post->content }}</p>
  </div>
  <div class="card-footer">
  <small class="text-muted">Posté par {{ $post->author }} a {{ $post->created_at}}</small>
    @if ($post->updated_at !=  $post->created_at )
    <small class="text-muted">Modifié le {{ $post->updated_at}}</small>
    @endif
    @auth
    @if ($post->author ==  Auth::user()->name )
    <a href="/delete/{{$post->id}}" class="btn btn-danger" role="button">Supprimer</a>
    <a href="/edit/{{$post->id}}" class="btn btn-primary" role="button">Modifier</a>
    @endif
    @endauth
  </div>
    </div>
@auth
@endauth
@endsection
