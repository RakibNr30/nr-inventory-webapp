<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AuthManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Ums\Entities\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Ums\Entities\UserAdditionalInfo;
use Modules\Ums\Entities\UserShippingInfo;
use Modules\Ums\Entities\UserSocialAccountInfo;
use function mysql_xdevapi\getSession;

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
    protected $redirectTo = '/backend/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Modules\Ums\Entities\User
     */
    protected function create(array $data)
    {
        $user = User::query()->create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        UserAdditionalInfo::query()->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'user_id' => $user->id
        ]);

        UserShippingInfo::query()->create([
            'user_id' => $user->id
        ]);

        UserSocialAccountInfo::query()->create([
            'user_id' => $user->id
        ]);

        // assign roles
        $user->assignRole(['Influencer']);

        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user) {
        if (!AuthManager::isProcessCompleted($user)) {
            auth()->logout();
            session(['user_id' => $user->id]);
            return redirect()->route('register.almost-ready');
        }
    }

    protected function showAlmostReady() {
        $user_id = session('user_id');
        session()->forget('user_id');

        $user = User::query()->findOrFail($user_id);

        Auth::login($user, true);

        return view('auth.register_almost_ready');
    }

    protected function storeAlmostReady() {
        $user = User::query()->findOrFail(auth()->user()->id);

        dd($user);
    }
}
