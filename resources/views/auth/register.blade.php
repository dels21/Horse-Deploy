<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="container p-0">
            <!-- Name -->
            <div class="mt-4 row">
                <label for="name">Nama lengkap</label>
                <input type="text" id="name" class="block mt-1 w-full form-control shadow-sm" name="name":value="old('name')" required autofocus autocomplete="name">
                {{-- @if ($errors->get('name'))
                    <ul class="mt-2 text-sm text-red-600 space-y-1">
                        @foreach ((array) $messages as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif --}}

            </div>

            <!-- Email Address -->
            <div class="mt-4 row">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                {{-- <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" /> --}}
            </div>

            <!-- Password -->
            <div class="mt-4 row">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Password Confirmation --}}
            <div class="mt-4 row">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>



        <div class="flex justify-content-center">
            <div class="d-flex items-center justify-content-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg ">Register</button>
            </div>
            <div class="d-flex items-center justify-content-center mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                   Sudah punya akun?
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
