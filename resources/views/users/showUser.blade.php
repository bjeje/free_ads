@extends('index')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="login"><span class="firstLetter">M</span>on profil</h3>

                <div class="card box__card_profil">
                    <div class="card__user">
                        <h4 class="user__info">Login : {{ $user->login }}</h4>
                        <h4 class="user__info">Prénom : {{ $user->firstname }}</h4>
                        <h4 class="user__info">Email : {{ $user->email }}</h4>
                        <h4 class="user__info">Date de création : {{ $user->created_at }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
