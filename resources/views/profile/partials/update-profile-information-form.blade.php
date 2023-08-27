<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información Del Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Para actualizar la información del perfil, modifique el campo del formulario deseado.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div>
            <x-input-label for="phone" :value="__('Celular')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full"
                :value="old('phone', $user->phone)" autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="identification_number" :value="__('Cédula')" />
            <x-text-input id="identification_number" name="identification_number" type="text" class="block mt-1 w-full"
                :value="old('identification_number', $user->identification_number)" required
                autocomplete="identification_number" />
            <x-input-error class="mt-2" :messages="$errors->get('identification_number')" />
        </div>

        <div class="mt-4">
            <x-input-label for="date_of_birth" :value="__('Fecha De Nacimiento')" />
            <x-text-input id="date_of_birth" type="date" name="date_of_birth" class="block mt-1 w-full"
                :value="old('date_of_birth', $user->date_of_birth)" required autocomplete="date_of_birth" />
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>

        <div class="mt-4">
            <x-input-label for="city_code" :value="__('Código Ciudad')" />
            <x-text-input id="city_code" type="text" name="city_code" class="block mt-1 w-full"
                :value="old('city_code', $user->city_code)" required autocomplete="city_code" />
            <x-input-error class="mt-2" :messages="$errors->get('city_code')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>