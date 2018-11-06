@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rechercher par catégories</div>

                <div class="card-body">
                    <form method="POST" action="/search-result" aria-label="">
                        @csrf

                        <div class="form-group row">
                            <label for="categories"class="col-md-4 col-form-label text-md-right">Catégories : </label>
                            <select name="categories" class="form-control col-md-6" id="categories">
                                @foreach($categories as $k => $category)
                                <option value="{{$k}}">{{$category}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Rechercher') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
<div class="container">
  <h1>Annonces</h1>
  <div class="card-deck">
  @foreach ($posts as $post)
  <div class="card mb-5">
    <img class="card-img-top" src="{{$post->image}}" alt="Card image cap">
    <div class="card-body">
    <h5 class="card-title">{{ $post->title }}</h5>
     @foreach($post->tags as $tag)
     <span class="badge badge-primary">{{$tag->name}}</span>
     @endforeach
   </div>
   <div class="card-body">
    <p class="card-text">{{ $post->content }}</p>
  </div>
  <div class="card-footer">
  <small class="text-muted">Posté par {{ $post->author }} à {{ $post->created_at}}</small>
    @if ($post->updated_at !=  $post->created_at )
    <small class="text-muted">Modifié le {{ $post->updated_at}}</small>
    @endif
    @auth
    @if ($post->author ==  Auth::user()->name )
    <a href="/delete/{{$post->id}}" class="btn btn-danger" role="button">Delete</a>
    <a href="/edit/{{$post->id}}" class="btn btn-primary" role="button">Update</a>
    @endif
    @endauth
    <a href="/annonce/{{$post->id}}" class="btn btn-success" role="button">Show</a>
  </div>
</div>
@endforeach
</div>
</div>

@endsection