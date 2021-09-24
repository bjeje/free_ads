<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;

use App\Http\Requests\UserAddRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(UserAddRequest $request)
    {
        $user = new User();
        $user->login = $request->login;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = sha1(time());
        $user->save();

        if($user !== null) {
            MailController::sendSignupEmail($user->firstname, $user->email, $user->verification_code);
            return redirect()->back()->with('alert-success', 'Votre demande a bien été enregistré. Merci de verifier votre e-mail pour confirmer');
        }
        return redirect()->back()->with('alert-danger', "Le mail n'a pas été envoyé!");
    }

    public function verifyUser(Request $request){
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->is_verified = 1;
            $user->save();
            return redirect()->route('login')->with(session()->flash('alert-success', 'Votre compte est validé. Merci de vous connecter!'));
        }

        return redirect()->route('login')->with(session()->flash('alert-danger', 'code de vérification non valide!'));
    }
}
