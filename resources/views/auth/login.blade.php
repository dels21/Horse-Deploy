<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        {{-- <div class="form-outline mb-4">
            <label class="form-label" for="form2Example11">Email</label>
            <input type="email" id="form2Example11" class="form-control"
                placeholder="Masukkan alamat email anda disini" />
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example22">Password</label>
            <input type="password" id="form2Example22" class="form-control"
            placeholder="Masukkan password anda disini"/>
        </div>

        <div class="text-center pt-1 mb-5 pb-1">
            <button class="btn btn-primary btn-block fa-lg mb-3" type="button">Login</button>
            <!-- <a class="text-muted" href="#!">Forgot password?</a> -->
        </div>

        <div class="d-flex align-items-center justify-content-center pb-4 ">
            <p class="mb-0 mr-3">Tidak punya akun?</p>
            <button  type="button" class="btn btn-outline-danger">Buat akun</button>
        </div> --}}

        <!-- Email Address -->
        <div class="form-outline mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input placeholder="Masukkan alamat email anda disini" id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input placeholder="Masukkan password anda disini" id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
        <div class="d-flex justify-content-center">
            <div class="flex items-center justify-content-center mt-4">
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}

                <x-primary-button class="ms-3 btn btn-lg">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

        </div>
            <div class="d-flex justify-content-center">
                <a class="mt-2 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    Belum punya akun?
                </a>

            </div>
            <div class="d-flex justify-content-center">
                <a class="mt-2 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    Lupa password?
                 </a>

            </div>

    </form>
</x-guest-layout>
