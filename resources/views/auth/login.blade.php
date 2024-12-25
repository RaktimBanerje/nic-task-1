<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Step 1: Email Address Form -->
    @if (!session('otp_sent'))
        <form method="POST" action="{{ route('otp.send') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Send OTP') }}
                </x-primary-button>
            </div>
        </form>
    @endif

    <!-- Step 2: OTP Form -->
    @if (session('otp_sent'))
        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf

            <!-- OTP -->
            <div>
                <x-input-label for="otp" :value="__('Enter OTP')" />
                <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" required autofocus autocomplete="off" />
                <x-input-error :messages="$errors->get('otp')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Verify OTP') }}
                </x-primary-button>
            </div>
        </form>
    @endif

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
            {{ __('Join as teacher') }}
        </a>
    </div>

</x-guest-layout>
