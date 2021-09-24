@extends('index')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="login"><span class="firstLetter">S</span>upprimer mon profil</h3>

                <div class="card box__card_delete">
                    <div class="card__delete">
                        <h4 class=" alert alert-danger user__delete">Êtes vous sur de vouloir supprimer Votre Profil?</h4>
                        <form class="form-horizontal" method="POST" action="{{ route('user.destroy', $user->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="form-group">
                                <div class="col-md-4 offset-4">
                                    <a class="btn btn-secondary " type="button" href="{{ url('/user/'. Auth::user()->id) }}">Non</a>
                                    <button type="submit" class="btn btn-danger">
                                        Oui
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
