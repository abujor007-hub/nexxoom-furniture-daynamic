<x-guest-layout>

    <style>
        body {
            min-height: 100vh;
            background-image:
                linear-gradient(
                    rgba(8, 16, 36, 0.18),
                    rgba(8, 16, 36, 0.42)
                ),
                url('{{ asset('icon and image/login.jpg') }}');

            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* Hide default Laravel Breeze logo */
        .min-h-screen > div:first-child {
            display: none !important;
        }

        /* Make default page background transparent */
        .min-h-screen {
            background-color: transparent !important;
        }
    </style>

    <!-- Session Status -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label
                for="email"
                :value="__('Email')"
            />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label
                for="password"
                :value="__('Password')"
            />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label
                for="remember_me"
                class="inline-flex items-center"
            >
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >

                <span class="ms-2 text-sm text-gray-600">
                    {{ __('Remember me') }}
                </span>
            </label>
        </div>

        <!-- Login Button -->
        <div class="flex items-center justify-end mt-4">

            @if (Route::has('password.request'))
                <a
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}"
                >
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>

        </div>

    </form>

    <!-- OR Divider -->
    <div class="flex items-center my-6">
        <div class="flex-grow border-t border-gray-300"></div>

        <span class="mx-4 text-sm text-gray-500">
            OR
        </span>

        <div class="flex-grow border-t border-gray-300"></div>
    </div>

    <!-- Google Login Button -->
    <a
        href="{{ route('google.login') }}"
        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5
               bg-white border border-gray-300 rounded-md shadow-sm
               text-sm font-medium text-gray-700
               hover:bg-gray-50
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >
        <!-- Google Icon -->
        <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M21.35 12.27c0-.79-.07-1.55-.2-2.27H12v4.3h5.24a4.48 4.48 0 0 1-1.94 2.94v2.45h3.14c1.84-1.69 2.91-4.18 2.91-7.42Z"
                fill="#4285F4"
            />

            <path
                d="M12 21.6c2.63 0 4.84-.87 6.45-2.36l-3.14-2.45c-.87.58-1.98.92-3.31.92-2.54 0-4.69-1.72-5.46-4.03H3.3v2.53A9.74 9.74 0 0 0 12 21.6Z"
                fill="#34A853"
            />

            <path
                d="M6.54 13.68a5.85 5.85 0 0 1 0-3.36V7.79H3.3a9.75 9.75 0 0 0 0 8.42l3.24-2.53Z"
                fill="#FBBC05"
            />

            <path
                d="M12 6.29c1.43 0 2.71.49 3.72 1.46l2.79-2.79C16.84 3.37 14.63 2.4 12 2.4a9.74 9.74 0 0 0-8.7 5.39l3.24 2.53C7.31 8.01 9.46 6.29 12 6.29Z"
                fill="#EA4335"
            />
        </svg>

        <span>
            Continue with Google
        </span>
    </a>

    <!-- Register Link -->
    @if (Route::has('register' ))
        <div class="text-center mt-6">
            <span class="text-sm text-gray-600">
                {{ __("Don't have an account?") }}
            </span>

            <a
                href="{{ route('register') }}"
                class="text-sm text-indigo-600 hover:text-indigo-900 underline"
            >
                {{ __('Register') }}
            </a>
        </div>
    @endif

</x-guest-layout>
