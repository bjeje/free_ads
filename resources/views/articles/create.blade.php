@extends('index')

@section('content')
    <div class="container">
        <h3 class="login"><span class="firstLetter">C</span>réer une annonce</h3>

        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach

        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('home.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title" class="control-label">Titre</label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title" type="text" id="title" value="{{ old('title') }}" autocomplete="title" autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" rows="4" name="description" type="textarea" id="description" autocomplete="description" autofocus>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="user-image mb-3 text-center">
                            <div class="imgPreview"> </div>
                        </div>

                        <div class="custom-file">
                            <input type="file" name="filenames[]" class="custom-file-input @error('filenames') is-invalid @enderror" id="filenames" multiple="multiple">
                            <label class="custom-file-label" for="filenames">Photo</label>
                            @error('filenames')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="control-label">Prix</label>
                        <input class="form-control @error('price') is-invalid @enderror" name="price" type="number" id="price" step=".01" value="{{ old('price') }}" autocomplete="price" autofocus>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category" class="control-label">Catégorie</label>
                        <select name="category" class="form-control" id="category">
                            @foreach (json_decode('{"": "Aucune","Immobilier":"Immobilier","Maison":"Maison","Multimedia":"Multimedia",
                            "Vehicules":"Vehicules","Loisirs":"Loisirs","Materiel":"Materiel","Services":"Services"}'
                            , true) as $optionKey => $optionValue)
                                <option value="{{ $optionKey }}" {{ (isset($article->category) && $article->category == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <a class="btn btn-info btn-sm" href="{{ url('/home') }}" title="Retour"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</a>

                            <input class="btn btn-success btn__submit" type="submit" value="envoyer">
                        </div>
                    </div>
                </form>
            </div>
@endsection
