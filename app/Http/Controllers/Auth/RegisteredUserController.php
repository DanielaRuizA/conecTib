<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $data['countries'] = Country::get(['name', 'id']);

        return view('auth.register', $data);
    }

    public function fetchState(Request $request): JsonResponse
    {
        $data['states'] = State::where('country_id', $request->country_id)->get(['name', 'id']);

        return response()->json($data);
    }

    public function fetchCity(Request $request): JsonResponse
    {
        $data['cities'] = City::where('state_id', $request->state_id)->get(['name', 'id']);

        return response()->json($data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Password::defaults(), Password::min(8)
                    ->numbers()
                    ->mixedCase()
                    ->symbols()],
                'phone' => ['numeric', 'digits:10', 'nullable'],
                'identification_number' => ['required', 'max:11'],
                'date_of_birth' => ['required', 'date', 'before:'.Carbon::now()->subYears(18)->format('Y-m-d')],
                'city_code' => ['required', 'numeric', 'digits:6'],
            ]);

            if ($validator->fails()) {
                return redirect('register')
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'identification_number' => $request->identification_number,
                'date_of_birth' => $request->date_of_birth,
                'city_code' => $request->city_code,
            ]);

            event(new Registered($user));

            Auth::login($user);

            Log::info('Usuario registrado exitosamente. ID de usuario: '.$user->id);

            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            Log::error('Error al registrar el usuario: '.$e->getMessage());
        }
    }
}
