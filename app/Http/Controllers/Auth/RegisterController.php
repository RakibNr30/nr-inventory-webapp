<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AuthManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Cms\Entities\InfluencerCategory;
use Modules\Ums\Entities\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Ums\Entities\UserAdditionalInfo;
use Modules\Ums\Entities\UserBusinessInfo;
use Modules\Ums\Entities\UserShippingInfo;
use Modules\Ums\Entities\UserSocialAccountInfo;
use Modules\Ums\Http\Requests\UserRegistrationRequest;
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
        if ($data['login_as'] == 1) {
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }

        if ($data['login_as'] == 2) {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Modules\Ums\Entities\User
     */
    protected function create(array $data)
    {
        if ($data['login_as'] == 1) {
            $user = User::query()->create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                "is_influencer" => true,
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
        }

        if ($data['login_as'] == 2) {
            $user = User::query()->create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                "is_brand" => true,
            ]);

            UserAdditionalInfo::query()->create([
                'first_name' => $data['name'], // brand name
                'user_id' => $user->id
            ]);

            UserBusinessInfo::query()->create([
                'user_id' => $user->id
            ]);

            // assign roles
            $user->assignRole(['Brand']);
        }

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

        //Auth::login($user, true);

        $influencerCategories = InfluencerCategory::query()->get();

        return view('auth.register_almost_ready', compact('influencerCategories', 'user'));
    }

    protected function storeAlmostReady(UserRegistrationRequest $request) {
        $data = $request->except(['_token']);
        $user = User::query()->findOrFail($data['user_id']);

        $user_data = [
            'categories' => array_map('intval', $data['categories'] ?? []),
            'terms_conditions' => $data['terms_conditions'] ?? 0,
            'subscribe' => $data['subscribe'] ?? 0,
        ];
        $user_additional_data = [
            'gender' => $data['gender'] ?? null
        ];
        $user_shipping_data = [
            'phone' => $data['phone'] ?? null,
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'address' => $data['address'] ?? null,
            'extra_info' => $data['extra_info'] ?? null,
            'zip_code' => $data['zip_code'] ?? null,
            'city' => $data['city'] ?? null,
            'country_code' => $data['country_code'] ?? null,
        ];
        $user_business_data = [
            'name' => $data['name'] ?? null,
            'address' => $data['address'] ?? null,
            'zip_code' => $data['zip_code'] ?? null,
            'city' => $data['city'] ?? null,
            'country_code' => $data['country_code'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'vat_number' => $data['vat_number'] ?? null,
            'registration_number' => $data['registration_number'] ?? null,
        ];
        $user_social_data = [
            'instagram_username' => $data['instagram_username'] ?? null,
            'tiktok_username' => $data['tiktok_username'] ?? null,
        ];

        $user = tap($user)->update($user_data);
        $user->additionalInfo->update($user_additional_data);

        if ($user->hasRole("Influencer")) {
            $user->shippingInfo->update($user_shipping_data);
            $user->socialAccountInfo->update($user_social_data);
        }
        if ($user->hasRole("Brand")) {
            $user->businessInfo->update($user_business_data);
        }

        // upload files
        $user->uploadFiles();

        $user->update(['is_process_completed' => true]);

        notifier()->success('Your registration completed. Now you can login.');
        return redirect()->route('login');
    }
}
