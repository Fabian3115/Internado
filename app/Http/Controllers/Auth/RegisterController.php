<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    public function redirectTo()
    {
        $role = auth()->user()->role;

        switch ($role) {
            case 'admin':
                return route('admin.dashboard');
            case 'aprendiz':
                return route('aprendiz.dashboard');

            default:
                return route('login');
        }
    }

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
            // Datos de la Persona
            'name'            => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'type_document'   => 'required|in:CC,TI,CE,PP,RC',
            'number_document' => 'required|string|max:30|unique:people,number_document',
            'number_phone'    => 'required|string|max:20',
            'gender'          => 'required|in:M,F',

            // Datos de usuario
            'nickname' => 'required|string|max:50|unique:users,nickname',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,aprendiz',

            // Imagen
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            // 1) Insertamos en people
            $person = Person::create([
                'name'            => $data['name'],
                'last_name'       => $data['last_name'],
                'type_document'   => $data['type_document'],
                'number_document' => $data['number_document'],
                'number_phone'    => $data['number_phone'],
                'gender'          => $data['gender'],
            ]);

            // 2) Procesar imagen (si existe)
            $profilePhotoPath = null;
            if (request()->hasFile('profile_photo')) {
                $file = request()->file('profile_photo');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/profile_photos'), $filename);
                $profilePhotoPath = 'images/profile_photos/' . $filename;
            }

            // 2) Insertamos en users con la FK
            return User::create([
                'nickname'  => $data['nickname'],
                'email'     => $data['email'],
                'password'  => Hash::make($data['password']),
                'role'      => $data['role'],
                'person_id' => $person->id,   // 🔗
                'profile_photo_path'  => $profilePhotoPath,
            ]);
        });
    }
}
