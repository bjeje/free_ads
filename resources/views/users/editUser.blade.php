@extends('index')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="login"><span class="firstLetter">M</span>odifier mon profil</h3>
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                </div>

                <div class="card">
                    <div class="card__register">
                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="login" class="col-md-4 col-form-label label">{{ __('Login') }}</label>

                                <div class="">
                                    <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{$user->login}}" autocomplete="login" autofocus>

                                    @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="firstname" class="col-md-4 col-form-label label">{{ __('Prénom') }}</label>

                                <div class="">
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" autocomplete="firstname" autofocus>

                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 col-form-label label">{{ __('E-Mail') }}</label>

                                <div class="">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 col-form-label label">{{ __('Mot de passe') }}</label>

                                <div class="">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-form-label label">{{ __('Confirmation du mot de passe') }}</label>

                                <div class="">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-7 offset-md-5">
                                    <button type="submit" class="btn btn-send">
                                        {{ __('Envoyer') }}
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
