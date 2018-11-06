@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Creez votre annonce</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('createPost') }}" aria-label="">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('Titre') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                            </div>
                        </div>
                        <!-- Image -->
                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label text-md-right">{{ __('Image url') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="text" class="form-control" name="image" value="{{ old('image') }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Contenu') }}</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control" name="content" rows="10" required style="resize:none;"></textarea>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categories"class="col-md-4 col-form-label text-md-right">Catégories</label>
                            <select name="categories[]" class="form-control col-md-6" id="tags" multiple>
                                @foreach($categories as $k => $category)
                                <option value="{{$k}}">{{$category}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Envoyer') }}
                                </button>
                                <a href="/">Retour à l'accueil sans valider</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection