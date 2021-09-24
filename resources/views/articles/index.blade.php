@extends('index')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box__search-bar col-md-12">

                    <form method="get" action="{{route('searchArticle')}}">
                        @csrf
                        @method('GET')
                        <div class="row">

                            <a class="btn btn-sm btn-success btn--add" href="{{ url('/home/create') }}" style="width: min-content; display:flex">
                                <i class="fa fa-plus icon--add" aria-hidden="true"></i>ajouter
                            </a>

                            <div class="col-md-2">
                                <label for="category" class="control-label" style="display:none">Catégorie</label>
                                <select name="category" class="form-control" id="category">
                                    @foreach (json_decode('{"": "Aucune","Immobilier":"Immobilier","Maison":"Maison","Multimedia":"Multimedia",
                                    "Vehicules":"Vehicules","Loisirs":"Loisirs","Materiel":"Materiel","Services":"Services"}'
                                    , true) as $optionKey => $optionValue)
                                        <option value="{{ $optionKey }}" {{ (isset($article->category) && $article->category == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="priceVal" style="display:flex">
                                <input type="number" class="form-control form-inline price" name="priceMin"
                                       placeholder="min" value="priceMin">
                                <input type="number" class="form-control form-inline price" name="priceMax"
                                       placeholder="max" value="priceMax">
                            </div>
                            <div class="col-md-2">
                                <label for="order" class="orderBy" style="display:none"></label>
                                <select class="form-control" name="order" id="order">
                                    <option value="">--option--</option>
                                    <option value="priceAsc">Prix croissant</option>
                                    <option value="priceDesc">Prix décroissant</option>
                                </select>
                            </div>
                            <div class="col-md-4 search-bar">
                                <form class="">
                                    <input id="searchTitle" name="searchTitle" class="form-control mr-sm-2" type="search" placeholder="Que recherchez vous?" aria-label="Search">
                                    <button class="btn btn-outline my-2 my-sm-0" type="submit">Rechercher</button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">

                    @foreach ($articles as $article)
                        <div class="col-md-4">
                            <div class="card card__little">
                                <div class="card__content">

                                    <h3 class="title__little">{{$article->title}}</h3>
                                    <h3 class="title__little">{{$article->price}} €</h3>
                                    @foreach ($article['images'] as $image)
                                        @if ($loop->first)
                                            <img class="card-img-top image" data-src="" alt="icon article"
                                                 src="{{asset('image/'.$image->image)}}">
                                        @endif
                                    @endforeach
                                    <!--<h3>{{$article->description}}</h3>-->


                                    <h3 class="date__little">{{$article->created_at}}</h3>
                                    <div class="box__link">
                                        <h3 class="category__little">{{$article->category}}</h3>
                                        <a class="link__little" href="{{route('home.show', $article)}}">Voir l'article</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
