@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="card card__big">

                        <div class="card__content_big">
                            <h3 class="title__big offset-4">{{$article->title}}</h3>
                            <a class="link__back" href="{{ url('/home') }}"><i class="fas fa-arrow-left"></i></a>
                            <div class="row">
                                <div class="col-md-4">
                                    @foreach ($article['images'] as $image)
                                        <img class="card-img-top image__big" data-src="" alt="icon article"
                                             src="{{asset('image/'.$image->image)}}">
                                    @endforeach
                                </div>
                                <div class="col-md-8">
                                    <h3 class="title__little">{{$article->price}} €</h3>
                                    <h3 class="description__big">{{$article->description}}</h3>

                                    <div class="box__link">
                                        <h3 class="category__little">{{$article->category}}</h3>
                                        <h3 class="date__little">{{$article->created_at}}</h3>
                                        <div class="control" style="display: flex">
                                            @can('owner-article', $article)
                                            <form method="post" action="{{ route('home.edit', $article->id) }}">
                                                @csrf
                                                @method('GET')
                                                <button class="btn-sm btn__modify">Modifier</button>
                                            </form>

                                            <form method="post" action="{{ route('home.destroy', $article->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-sm btn__delete" style="margin-left: 0.5em"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
